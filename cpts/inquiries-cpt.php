<?php
/**
 * Register Contact Inquiries Custom Post Type
 */
function register_inquiries_post_type() {
    $labels = array(
        'name'                  => _x('Inquiries', 'Post Type General Name', 'limadia-entity-foundation-v1'),
        'singular_name'         => _x('Inquiry', 'Post Type Singular Name', 'limadia-entity-foundation-v1'),
        'menu_name'             => __('Inquiries', 'limadia-entity-foundation-v1'),
        'name_admin_bar'        => __('Inquiry', 'limadia-entity-foundation-v1'),
        'all_items'             => __('All Inquiries', 'limadia-entity-foundation-v1'),
        'add_new_item'          => __('Add New Inquiry', 'limadia-entity-foundation-v1'),
        'add_new'               => __('Add New', 'limadia-entity-foundation-v1'),
        'new_item'              => __('New Inquiry', 'limadia-entity-foundation-v1'),
        'edit_item'             => __('View Inquiry', 'limadia-entity-foundation-v1'),
        'update_item'           => __('Update Inquiry', 'limadia-entity-foundation-v1'),
        'view_item'             => __('View Inquiry', 'limadia-entity-foundation-v1'),
        'view_items'            => __('View Inquiries', 'limadia-entity-foundation-v1'),
        'search_items'          => __('Search Inquiry', 'limadia-entity-foundation-v1'),
        'not_found'             => __('Not found', 'limadia-entity-foundation-v1'),
        'not_found_in_trash'    => __('Not found in Trash', 'limadia-entity-foundation-v1'),
    );
    $args = array(
        'label'                 => __('Inquiry', 'limadia-entity-foundation-v1'),
        'labels'                => $labels,
        'supports'              => array('title'), // We'll use the subject/name as title
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-email-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'capabilities'          => array(
            'create_posts' => false, // Only created via form
        ),
        'map_meta_cap'          => true,
    );
    register_post_type('inquiry', $args);
}
add_action('init', 'register_inquiries_post_type');

/**
 * Add Meta Box for Inquiry Details
 */
function add_inquiry_meta_boxes() {
    add_meta_box(
        'inquiry_details',
        __('Inquiry Details', 'limadia-entity-foundation-v1'),
        'inquiry_details_callback',
        'inquiry',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_inquiry_meta_boxes');

function inquiry_details_callback($post) {
    // Mark as read
    update_post_meta($post->ID, '_inquiry_read_status', '1');

    $name    = get_post_meta($post->ID, '_inquiry_name', true);
    $email   = get_post_meta($post->ID, '_inquiry_email', true);
    $subject = get_post_meta($post->ID, '_inquiry_subject', true);
    $phone   = get_post_meta($post->ID, '_inquiry_phone', true);
    $message = get_post_meta($post->ID, '_inquiry_message', true);
    ?>
    <table class="form-table">
        <tr>
            <th><strong><?php _e('Name:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo esc_html($name); ?></td>
        </tr>
        <tr>
            <th><strong><?php _e('Email:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></td>
        </tr>
        <tr>
            <th><strong><?php _e('Phone:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo esc_html($phone); ?></td>
        </tr>
        <tr>
            <th><strong><?php _e('Subject:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo esc_html($subject); ?></td>
        </tr>
        <tr>
            <th><strong><?php _e('Message:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo nl2br(esc_html($message)); ?></td>
        </tr>
    </table>
    <?php
}

/**
 * Custom Columns
 */
function set_custom_inquiry_columns($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => __('Subject', 'limadia-entity-foundation-v1'),
        'inquiry_name' => __('From', 'limadia-entity-foundation-v1'),
        'inquiry_email' => __('Email', 'limadia-entity-foundation-v1'),
        'date' => __('Date', 'limadia-entity-foundation-v1'),
    );
    return $new_columns;
}
add_filter('manage_inquiry_posts_columns', 'set_custom_inquiry_columns');

function display_inquiry_columns($column, $post_id) {
    switch ($column) {
        case 'inquiry_name':
            $status = get_post_meta($post_id, '_inquiry_read_status', true);
            echo esc_html(get_post_meta($post_id, '_inquiry_name', true));
            if ($status !== '1') {
                echo ' <span class="badge-new" style="background: #FA7920; color: #fff; padding: 2px 6px; border-radius: 4px; font-size: 10px; margin-left: 5px; text-transform: uppercase;">' . __('New', 'limadia-entity-foundation-v1') . '</span>';
            }
            break;
        case 'inquiry_email':
            echo esc_html(get_post_meta($post_id, '_inquiry_email', true));
            break;
    }
}
add_action('manage_inquiry_posts_custom_column', 'display_inquiry_columns', 10, 2);

/**
 * Menu Badge for Unread Inquiries
 */
function add_inquiry_menu_badge() {
    global $menu;
    
    $unread_args = array(
        'post_type'      => 'inquiry',
        'posts_per_page' => -1,
        'meta_query'     => array(
            array(
                'key'     => '_inquiry_read_status',
                'value'   => '0',
                'compare' => '='
            )
        )
    );
    $unread_count = count(get_posts($unread_args));

    if ($unread_count > 0) {
        foreach ($menu as $key => $value) {
            if ($value[2] == 'edit.php?post_type=inquiry') {
                $menu[$key][0] .= " <span class='update-plugins count-$unread_count'><span class='plugin-count'>" . number_format_i18n($unread_count) . "</span></span>";
            }
        }
    }
}
add_action('admin_menu', 'add_inquiry_menu_badge', 999);
