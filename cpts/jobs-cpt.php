<?php
/**
 * Register Jobs Custom Post Type
 */
function register_jobs_post_type() {
    $labels = array(
        'name'                  => _x('Jobs', 'Post Type General Name', 'limadia-entity-foundation-v1'),
        'singular_name'         => _x('Job', 'Post Type Singular Name', 'limadia-entity-foundation-v1'),
        'menu_name'             => __('Jobs', 'limadia-entity-foundation-v1'),
        'name_admin_bar'        => __('Job', 'limadia-entity-foundation-v1'),
        'archives'              => __('Job Archives', 'limadia-entity-foundation-v1'),
        'attributes'            => __('Job Attributes', 'limadia-entity-foundation-v1'),
        'parent_item_colon'     => __('Parent Job:', 'limadia-entity-foundation-v1'),
        'all_items'             => __('All Jobs', 'limadia-entity-foundation-v1'),
        'add_new_item'          => __('Add New Job', 'limadia-entity-foundation-v1'),
        'add_new'               => __('Add New', 'limadia-entity-foundation-v1'),
        'new_item'              => __('New Job', 'limadia-entity-foundation-v1'),
        'edit_item'             => __('Edit Job', 'limadia-entity-foundation-v1'),
        'update_item'           => __('Update Job', 'limadia-entity-foundation-v1'),
        'view_item'             => __('View Job', 'limadia-entity-foundation-v1'),
        'view_items'            => __('View Jobs', 'limadia-entity-foundation-v1'),
        'search_items'          => __('Search Job', 'limadia-entity-foundation-v1'),
        'not_found'             => __('Not found', 'limadia-entity-foundation-v1'),
        'not_found_in_trash'    => __('Not found in Trash', 'limadia-entity-foundation-v1'),
        'featured_image'        => __('Featured Image', 'limadia-entity-foundation-v1'),
        'set_featured_image'    => __('Set featured image', 'limadia-entity-foundation-v1'),
        'remove_featured_image' => __('Remove featured image', 'limadia-entity-foundation-v1'),
        'use_featured_image'    => __('Use as featured image', 'limadia-entity-foundation-v1'),
        'insert_into_item'      => __('Insert into job', 'limadia-entity-foundation-v1'),
        'uploaded_to_this_item' => __('Uploaded to this job', 'limadia-entity-foundation-v1'),
        'items_list'            => __('Jobs list', 'limadia-entity-foundation-v1'),
        'items_list_navigation' => __('Jobs list navigation', 'limadia-entity-foundation-v1'),
        'filter_items_list'     => __('Filter jobs list', 'limadia-entity-foundation-v1'),
    );
    $args = array(
        'label'                 => __('Job', 'limadia-entity-foundation-v1'),
        'description'           => __('Job Openings', 'limadia-entity-foundation-v1'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-businessman',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type('job', $args);
}
add_action('init', 'register_jobs_post_type');

/**
 * Add Meta Box for Job Details
 */
function add_job_meta_boxes() {
    add_meta_box(
        'job_details_meta_box',
        __('Job Details', 'limadia-entity-foundation-v1'),
        'job_details_meta_box_callback',
        'job',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_job_meta_boxes');

function job_details_meta_box_callback($post) {
    wp_nonce_field('save_job_details', 'job_details_nonce');
    
    $location = get_post_meta($post->ID, '_job_location', true);
    $type     = get_post_meta($post->ID, '_job_type', true);
    $salary   = get_post_meta($post->ID, '_job_salary', true);
    $closing  = get_post_meta($post->ID, '_job_closing_date', true);
    $status   = get_post_meta($post->ID, '_job_status', true);
    if (!$status) $status = 'Open';
    
    $job_types = array('Full Time', 'Part Time', 'Contract', 'Internship', 'Remote');
    ?>
    <p>
        <label for="job_status"><strong><?php _e('Current Status:', 'limadia-entity-foundation-v1'); ?></strong></label><br>
        <select id="job_status" name="job_status" class="widefat">
            <option value="Open" <?php selected($status, 'Open'); ?>>Open (Accepting Applications)</option>
            <option value="Closed" <?php selected($status, 'Closed'); ?>>Closed (Not Accepting Applications)</option>
        </select>
    </p>
    <p>
        <label for="job_location"><strong><?php _e('Location:', 'limadia-entity-foundation-v1'); ?></strong></label><br>
        <input type="text" id="job_location" name="job_location" value="<?php echo esc_attr($location); ?>" class="widefat" placeholder="e.g. Kumasi, Ghana">
    </p>
    <p>
        <label for="job_type"><strong><?php _e('Job Type:', 'limadia-entity-foundation-v1'); ?></strong></label><br>
        <select id="job_type" name="job_type" class="widefat">
            <option value=""><?php _e('Select Job Type', 'limadia-entity-foundation-v1'); ?></option>
            <?php foreach ($job_types as $jt) : ?>
                <option value="<?php echo esc_attr($jt); ?>" <?php selected($type, $jt); ?>><?php echo esc_html($jt); ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="job_salary"><strong><?php _e('Salary / Compensation:', 'limadia-entity-foundation-v1'); ?></strong></label><br>
        <input type="text" id="job_salary" name="job_salary" value="<?php echo esc_attr($salary); ?>" class="widefat" placeholder="e.g. $2000 - $3000 or Competitive">
    </p>
    <p>
        <label for="job_closing_date"><strong><?php _e('Closing Date:', 'limadia-entity-foundation-v1'); ?></strong></label><br>
        <input type="date" id="job_closing_date" name="job_closing_date" value="<?php echo esc_attr($closing); ?>" class="widefat">
    </p>
    <?php
}

function save_job_details_meta($post_id) {
    if (!isset($_POST['job_details_nonce']) || !wp_verify_nonce($_POST['job_details_nonce'], 'save_job_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['job_location'])) {
        update_post_meta($post_id, '_job_location', sanitize_text_field($_POST['job_location']));
    }
    if (isset($_POST['job_type'])) {
        update_post_meta($post_id, '_job_type', sanitize_text_field($_POST['job_type']));
    }
    if (isset($_POST['job_salary'])) {
        update_post_meta($post_id, '_job_salary', sanitize_text_field($_POST['job_salary']));
    }
    if (isset($_POST['job_closing_date'])) {
        update_post_meta($post_id, '_job_closing_date', sanitize_text_field($_POST['job_closing_date']));
    }
    if (isset($_POST['job_status'])) {
        update_post_meta($post_id, '_job_status', sanitize_text_field($_POST['job_status']));
    }
}
add_action('save_post', 'save_job_details_meta');

/**
 * Add custom columns to Jobs list in admin
 */
function set_custom_edit_job_columns($columns) {
    $new_columns = array();
    foreach($columns as $key => $value) {
        if ($key == 'date') {
            $new_columns['job_status'] = __('Status', 'limadia-entity-foundation-v1');
            $new_columns['closing_date'] = __('Closing Date', 'limadia-entity-foundation-v1');
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
}
add_filter('manage_job_posts_columns', 'set_custom_edit_job_columns');

/**
 * Display content for custom columns
 */
function custom_job_column( $column, $post_id ) {
    switch ( $column ) {
        case 'job_status' :
            $status = get_post_meta($post_id, '_job_status', true);
            if (!$status) $status = 'Open';
            $class = ($status == 'Open') ? 'text-success' : 'text-danger';
            echo '<strong class="' . $class . '">' . esc_html($status) . '</strong>';
            break;

        case 'closing_date' :
            $closing = get_post_meta($post_id, '_job_closing_date', true);
            if ($closing) {
                echo esc_html(date("M j, Y", strtotime($closing)));
            } else {
                echo '—';
            }
            break;
    }
}
add_action( 'manage_job_posts_custom_column' , 'custom_job_column', 10, 2 );

/**
 * Make columns sortable
 */
function make_job_columns_sortable( $columns ) {
    $columns['closing_date'] = 'closing_date';
    $columns['job_status'] = 'job_status';
    return $columns;
}
add_filter( 'manage_edit-job_sortable_columns', 'make_job_columns_sortable' );

