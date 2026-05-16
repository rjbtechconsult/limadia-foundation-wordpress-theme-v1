<?php
/**
 * Register Donation Inquiries Custom Post Type
 */
function register_donations_post_type() {
    $labels = array(
        'name'                  => _x('Donations', 'Post Type General Name', 'limadia-entity-foundation-v1'),
        'singular_name'         => _x('Donation', 'Post Type Singular Name', 'limadia-entity-foundation-v1'),
        'menu_name'             => __('Donations', 'limadia-entity-foundation-v1'),
        'name_admin_bar'        => __('Donation', 'limadia-entity-foundation-v1'),
        'all_items'             => __('All Donations', 'limadia-entity-foundation-v1'),
        'add_new_item'          => __('Add New Donation', 'limadia-entity-foundation-v1'),
        'add_new'               => __('Add New', 'limadia-entity-foundation-v1'),
        'new_item'              => __('New Donation', 'limadia-entity-foundation-v1'),
        'edit_item'             => __('View Donation', 'limadia-entity-foundation-v1'),
        'update_item'           => __('Update Donation', 'limadia-entity-foundation-v1'),
        'view_item'             => __('View Donation', 'limadia-entity-foundation-v1'),
        'view_items'            => __('View Donations', 'limadia-entity-foundation-v1'),
        'search_items'          => __('Search Donation', 'limadia-entity-foundation-v1'),
        'not_found'             => __('Not found', 'limadia-entity-foundation-v1'),
        'not_found_in_trash'    => __('Not found in Trash', 'limadia-entity-foundation-v1'),
    );
    $args = array(
        'label'                 => __('Donation', 'limadia-entity-foundation-v1'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-heart',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'capabilities'          => array(
            'create_posts' => false,
        ),
        'map_meta_cap'          => true,
    );
    register_post_type('donation', $args);
}
add_action('init', 'register_donations_post_type');

/**
 * Add Meta Box for Donation Details
 */
function add_donation_meta_boxes() {
    add_meta_box(
        'donation_details',
        __('Donation Details', 'limadia-entity-foundation-v1'),
        'donation_details_callback',
        'donation',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_donation_meta_boxes');

function donation_details_callback($post) {
    $name     = get_post_meta($post->ID, '_donation_name', true);
    $email    = get_post_meta($post->ID, '_donation_email', true);
    $purpose  = get_post_meta($post->ID, '_donation_purpose', true);
    $amount   = get_post_meta($post->ID, '_donation_amount', true);
    $currency = get_post_meta($post->ID, '_donation_currency', true);
    $type     = get_post_meta($post->ID, '_donation_payment_type', true);
    ?>
    <table class="form-table">
        <tr>
            <th><strong><?php _e('Donor Name:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo esc_html($name); ?></td>
        </tr>
        <tr>
            <th><strong><?php _e('Email:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></td>
        </tr>
        <tr>
            <th><strong><?php _e('Purpose:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo esc_html($purpose); ?></td>
        </tr>
        <tr>
            <th><strong><?php _e('Amount:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo esc_html($amount) . ' ' . esc_html($currency); ?></td>
        </tr>
        <tr>
            <th><strong><?php _e('Payment Type:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo ucfirst(str_replace('_', ' ', esc_html($type))); ?></td>
        </tr>
    </table>
    <?php
}

/**
 * Custom Columns for Donations
 */
function set_custom_donation_columns($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => __('Donor', 'limadia-entity-foundation-v1'),
        'donation_amount' => __('Amount', 'limadia-entity-foundation-v1'),
        'donation_purpose' => __('Purpose', 'limadia-entity-foundation-v1'),
        'date' => __('Date', 'limadia-entity-foundation-v1'),
    );
    return $new_columns;
}
add_filter('manage_donation_posts_columns', 'set_custom_donation_columns');

function display_donation_columns($column, $post_id) {
    switch ($column) {
        case 'donation_amount':
            $amount = get_post_meta($post_id, '_donation_amount', true);
            $currency = get_post_meta($post_id, '_donation_currency', true);
            echo esc_html($amount) . ' ' . esc_html($currency);
            break;
        case 'donation_purpose':
            echo esc_html(get_post_meta($post_id, '_donation_purpose', true));
            break;
    }
}
add_action('manage_donation_posts_custom_column', 'display_donation_columns', 10, 2);
