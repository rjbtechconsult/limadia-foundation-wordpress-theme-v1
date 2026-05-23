<?php
/**
 * Register Job Applications Custom Post Type
 */
function register_job_applications_post_type() {
    $labels = array(
        'name'                  => _x('Applications', 'Post Type General Name', 'limadia-entity-foundation-v1'),
        'singular_name'         => _x('Application', 'Post Type Singular Name', 'limadia-entity-foundation-v1'),
        'menu_name'             => __('Job Applications', 'limadia-entity-foundation-v1'),
        'name_admin_bar'        => __('Application', 'limadia-entity-foundation-v1'),
        'all_items'             => __('All Applications', 'limadia-entity-foundation-v1'),
        'add_new_item'          => __('Add New Application', 'limadia-entity-foundation-v1'),
        'add_new'               => __('Add New', 'limadia-entity-foundation-v1'),
        'new_item'              => __('New Application', 'limadia-entity-foundation-v1'),
        'edit_item'             => __('View Application', 'limadia-entity-foundation-v1'),
        'update_item'           => __('Update Application', 'limadia-entity-foundation-v1'),
        'view_item'             => __('View Application', 'limadia-entity-foundation-v1'),
        'view_items'            => __('View Applications', 'limadia-entity-foundation-v1'),
        'search_items'          => __('Search Application', 'limadia-entity-foundation-v1'),
        'not_found'             => __('Not found', 'limadia-entity-foundation-v1'),
        'not_found_in_trash'    => __('Not found in Trash', 'limadia-entity-foundation-v1'),
    );
    $args = array(
        'label'                 => __('Application', 'limadia-entity-foundation-v1'),
        'labels'                => $labels,
        'supports'              => array('title'), // We'll use the applicant name as the title
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=job', // Nest it under the Jobs menu
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'capabilities'          => array(
            'create_posts' => false, // Applications are only created via the frontend form
        ),
        'map_meta_cap'          => true,
    );
    register_post_type('job_application', $args);
}
add_action('init', 'register_job_applications_post_type');

/**
 * Add Meta Box for Application Details
 */
function add_job_application_meta_boxes() {
    add_meta_box(
        'job_application_details',
        __('Application Details', 'limadia-entity-foundation-v1'),
        'job_application_details_callback',
        'job_application',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_job_application_meta_boxes');

function job_application_details_callback($post) {
    // Mark as read when viewed
    update_post_meta($post->ID, '_application_read_status', '1');

    $email     = get_post_meta($post->ID, '_applicant_email', true);
    $phone     = get_post_meta($post->ID, '_applicant_phone', true);
    $portfolio = get_post_meta($post->ID, '_applicant_portfolio', true);
    $job_id    = get_post_meta($post->ID, '_job_id', true);
    $cv_id     = get_post_meta($post->ID, '_applicant_cv_id', true);
    $cl_id     = get_post_meta($post->ID, '_applicant_cover_letter_id', true);
    
    $job_title = $job_id ? get_the_title($job_id) : 'Unknown Job';

    // Normalize portfolio URL if it doesn't have a protocol, so it doesn't link relatively in the admin area
    $portfolio_url = $portfolio;
    if ($portfolio_url && !preg_match('/^(https?|ftp):\/\//i', $portfolio_url)) {
        $portfolio_url = 'http://' . $portfolio_url;
    }
    ?>
    <table class="form-table">
        <tr>
            <th><strong><?php _e('Job Applied For:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo esc_html($job_title); ?> (ID: <?php echo esc_html($job_id); ?>)</td>
        </tr>
        <tr>
            <th><strong><?php _e('Applicant Email:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></td>
        </tr>
        <tr>
            <th><strong><?php _e('Applicant Phone:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><?php echo esc_html($phone); ?></td>
        </tr>
        <?php if ($portfolio) : ?>
        <tr>
            <th><strong><?php _e('Portfolio/Website:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><a href="<?php echo esc_url($portfolio_url); ?>" target="_blank"><?php echo esc_html($portfolio); ?></a></td>
        </tr>
        <?php endif; ?>
        <?php if ($cl_id) : ?>
        <tr>
            <th><strong><?php _e('Cover Letter:', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><a href="<?php echo wp_get_attachment_url($cl_id); ?>" class="button" target="_blank"><?php _e('Download/View Cover Letter', 'limadia-entity-foundation-v1'); ?></a></td>
        </tr>
        <?php endif; ?>
        <?php if ($cv_id) : ?>
        <tr>
            <th><strong><?php _e('Curriculum Vitae (CV):', 'limadia-entity-foundation-v1'); ?></strong></th>
            <td><a href="<?php echo wp_get_attachment_url($cv_id); ?>" class="button button-primary" target="_blank"><?php _e('Download/View CV', 'limadia-entity-foundation-v1'); ?></a></td>
        </tr>
        <?php endif; ?>
    </table>
    <?php
}

/**
 * Custom Admin Columns for Applications
 */
function set_custom_job_application_columns($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => __('Applicant Name', 'limadia-entity-foundation-v1'),
        'job_title' => __('Applied For', 'limadia-entity-foundation-v1'),
        'applicant_email' => __('Email', 'limadia-entity-foundation-v1'),
        'date' => __('Date Applied', 'limadia-entity-foundation-v1'),
    );
    return $new_columns;
}
add_filter('manage_job_application_posts_columns', 'set_custom_job_application_columns');

function display_job_application_columns($column, $post_id) {
    switch ($column) {
        case 'job_title':
            $job_id = get_post_meta($post_id, '_job_id', true);
            $job_title = $job_id ? get_the_title($job_id) : '—';
            $status = get_post_meta($post_id, '_application_read_status', true);
            
            echo '<a href="' . get_edit_post_link($post_id) . '">' . esc_html($job_title) . '</a>';
            if ($status !== '1') {
                echo ' <span class="badge-new" style="background: #FA7920; color: #fff; padding: 2px 6px; border-radius: 4px; font-size: 10px; margin-left: 5px; text-transform: uppercase;">' . __('New', 'limadia-entity-foundation-v1') . '</span>';
            }
            break;
        case 'applicant_email':
            echo esc_html(get_post_meta($post_id, '_applicant_email', true));
            break;
    }
}
add_action('manage_job_application_posts_custom_column', 'display_job_application_columns', 10, 2);

/**
 * Add a filter dropdown and Export button for Jobs in the Applications list
 */
function filter_applications_by_job() {
    global $typenow;
    if ($typenow == 'job_application') {
        $selected      = isset($_GET['filter_job_id']) ? $_GET['filter_job_id'] : '';
        $jobs_args     = array('post_type' => 'job', 'posts_per_page' => -1, 'post_status' => array('publish', 'private'));
        $jobs_posts    = get_posts($jobs_args);
        
        echo '<select name="filter_job_id">';
        echo '<option value="">' . __('Filter by Job', 'limadia-entity-foundation-v1') . '</option>';
        foreach ($jobs_posts as $job) {
            printf(
                '<option value="%s" %s>%s</option>',
                $job->ID,
                selected($selected, $job->ID, false),
                $job->post_title
            );
        }
        echo '</select>';

        // Export Button
        $export_url = add_query_arg(array(
            'export_job_applications' => '1',
            'filter_job_id' => $selected
        ), admin_url('edit.php?post_type=job_application'));
        
        echo '<a href="' . esc_url($export_url) . '" class="button button-secondary" style="float: right; margin-left: 10px;">' . __('Download CSV', 'limadia-entity-foundation-v1') . '</a>';
    }
}
add_action('restrict_manage_posts', 'filter_applications_by_job');

/**
 * Handle CSV Export
 */
function handle_job_application_csv_export() {
    if (isset($_GET['export_job_applications']) && is_admin() && current_user_can('edit_posts')) {
        $job_id = isset($_GET['filter_job_id']) ? intval($_GET['filter_job_id']) : 0;
        
        $args = array(
            'post_type'      => 'job_application',
            'posts_per_page' => -1,
            'post_status'    => 'any'
        );
        
        if ($job_id > 0) {
            $args['meta_query'] = array(
                array(
                    'key'     => '_job_id',
                    'value'   => $job_id,
                    'compare' => '='
                )
            );
        }
        
        $applications = get_posts($args);
        
        $filename = 'job-applications-' . date('Y-m-d-His') . '.csv';
        if ($job_id > 0) {
            $job_title = get_the_title($job_id);
            $safe_title = sanitize_title($job_title);
            $filename = 'applications-' . $safe_title . '-' . date('Y-m-d') . '.csv';
        }
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        
        // Header Row
        fputcsv($output, array(
            'Applicant Name',
            'Job Position',
            'Email',
            'Phone',
            'Portfolio',
            'Date Applied',
            'CV Link',
            'Cover Letter Link'
        ));
        
        foreach ($applications as $app) {
            $job_id_app = get_post_meta($app->ID, '_job_id', true);
            $cv_id      = get_post_meta($app->ID, '_applicant_cv_id', true);
            $cl_id      = get_post_meta($app->ID, '_applicant_cover_letter_id', true);
            $portfolio  = get_post_meta($app->ID, '_applicant_portfolio', true);
            
            $portfolio_url = $portfolio;
            if ($portfolio_url && !preg_match('/^(https?|ftp):\/\//i', $portfolio_url)) {
                $portfolio_url = 'http://' . $portfolio_url;
            }
            
            fputcsv($output, array(
                $app->post_title,
                get_the_title($job_id_app),
                get_post_meta($app->ID, '_applicant_email', true),
                get_post_meta($app->ID, '_applicant_phone', true),
                $portfolio_url,
                get_the_date('Y-m-d H:i:s', $app->ID),
                $cv_id ? wp_get_attachment_url($cv_id) : 'N/A',
                $cl_id ? wp_get_attachment_url($cl_id) : 'N/A'
            ));
        }
        
        fclose($output);
        exit;
    }
}
add_action('admin_init', 'handle_job_application_csv_export');

/**
 * Filter the query based on the selected job
 */
function apply_job_application_filter($query) {
    global $pagenow;
    $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
    
    if (is_admin() && $pagenow == 'edit.php' && $post_type == 'job_application' && isset($_GET['filter_job_id']) && $_GET['filter_job_id'] != '') {
        $query->query_vars['meta_key']   = '_job_id';
        $query->query_vars['meta_value'] = $_GET['filter_job_id'];
    }
}
add_filter('parse_query', 'apply_job_application_filter');

/**
 * Add red badge to the menu for unread applications
 */
function add_job_application_menu_badge() {
    global $menu, $submenu;
    
    $unread_args = array(
        'post_type'      => 'job_application',
        'posts_per_page' => -1,
        'meta_query'     => array(
            array(
                'key'     => '_application_read_status',
                'value'   => '0',
                'compare' => '='
            )
        )
    );
    $unread_count = count(get_posts($unread_args));

    if ($unread_count > 0) {
        $badge = " <span class='update-plugins count-$unread_count'><span class='plugin-count'>" . number_format_i18n($unread_count) . "</span></span>";
        
        // Add to parent menu (Jobs)
        foreach ($menu as $key => $value) {
            if ($value[2] == 'edit.php?post_type=job') {
                $menu[$key][0] .= $badge;
            }
        }
        
        // Add to submenu (Job Applications)
        if (isset($submenu['edit.php?post_type=job'])) {
            foreach ($submenu['edit.php?post_type=job'] as $key => $value) {
                // Check if this is the "Job Applications" menu item
                if ($value[2] == 'edit.php?post_type=job_application') {
                    $submenu['edit.php?post_type=job'][$key][0] .= $badge;
                }
            }
        }
    }
}
add_action('admin_menu', 'add_job_application_menu_badge', 999);

