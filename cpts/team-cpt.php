<?php
/**
 * Register Team Members Custom Post Type
 *
 * @package Limadia_Entity_Foundation_V1
 */

function register_team_member_post_type() {
    $labels = array(
        'name'                  => _x('Team Members', 'Post Type General Name', 'limadia-entity-foundation-v1'),
        'singular_name'         => _x('Team Member', 'Post Type Singular Name', 'limadia-entity-foundation-v1'),
        'menu_name'             => __('Team Members', 'limadia-entity-foundation-v1'),
        'name_admin_bar'        => __('Team Member', 'limadia-entity-foundation-v1'),
        'archives'              => __('Team Archives', 'limadia-entity-foundation-v1'),
        'attributes'            => __('Team Member Attributes', 'limadia-entity-foundation-v1'),
        'parent_item_colon'     => __('Parent Member:', 'limadia-entity-foundation-v1'),
        'all_items'             => __('All Members', 'limadia-entity-foundation-v1'),
        'add_new_item'          => __('Add New Member', 'limadia-entity-foundation-v1'),
        'add_new'               => __('Add New', 'limadia-entity-foundation-v1'),
        'new_item'              => __('New Member', 'limadia-entity-foundation-v1'),
        'edit_item'             => __('Edit Member', 'limadia-entity-foundation-v1'),
        'update_item'           => __('Update Member', 'limadia-entity-foundation-v1'),
        'view_item'             => __('View Member', 'limadia-entity-foundation-v1'),
        'view_items'            => __('View Members', 'limadia-entity-foundation-v1'),
        'search_items'          => __('Search Member', 'limadia-entity-foundation-v1'),
        'not_found'             => __('No members found', 'limadia-entity-foundation-v1'),
        'not_found_in_trash'    => __('No members found in Trash', 'limadia-entity-foundation-v1'),
        'featured_image'        => __('Profile Picture / Portrait', 'limadia-entity-foundation-v1'),
        'set_featured_image'    => __('Set profile picture', 'limadia-entity-foundation-v1'),
        'remove_featured_image' => __('Remove profile picture', 'limadia-entity-foundation-v1'),
        'use_featured_image'    => __('Use as profile picture', 'limadia-entity-foundation-v1'),
        'insert_into_item'      => __('Insert into member profile', 'limadia-entity-foundation-v1'),
        'uploaded_to_this_item' => __('Uploaded to this member', 'limadia-entity-foundation-v1'),
        'items_list'            => __('Team members list', 'limadia-entity-foundation-v1'),
        'items_list_navigation' => __('Team members list navigation', 'limadia-entity-foundation-v1'),
        'filter_items_list'     => __('Filter members list', 'limadia-entity-foundation-v1'),
    );

    $args = array(
        'label'                 => __('Team Member', 'limadia-entity-foundation-v1'),
        'description'           => __('Foundation Leadership & Team Members', 'limadia-entity-foundation-v1'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('team_member', $args);
}
add_action('init', 'register_team_member_post_type');

/**
 * Add Meta Boxes for Team Member Details
 */
function add_team_member_meta_boxes() {
    add_meta_box(
        'team_member_details_meta_box',
        __('Member Information & Social Links', 'limadia-entity-foundation-v1'),
        'team_member_details_meta_box_callback',
        'team_member',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_team_member_meta_boxes');

/**
 * Meta Box Callback Display
 */
function team_member_details_meta_box_callback($post) {
    wp_nonce_field('save_team_member_details', 'team_member_details_nonce');

    $role      = get_post_meta($post->ID, '_member_role', true);
    $bio       = get_post_meta($post->ID, '_member_bio', true);
    $email     = get_post_meta($post->ID, '_member_email', true);
    $phone     = get_post_meta($post->ID, '_member_phone', true);
    $linkedin  = get_post_meta($post->ID, '_member_linkedin', true);
    $twitter   = get_post_meta($post->ID, '_member_twitter', true);
    $facebook  = get_post_meta($post->ID, '_member_facebook', true);
    $instagram = get_post_meta($post->ID, '_member_instagram', true);
    ?>
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px;">
            <p style="margin: 0;">
                <label for="member_role" style="display: block; font-weight: 600; margin-bottom: 5px;">
                    <?php _e('Job Title / Designation / Role:', 'limadia-entity-foundation-v1'); ?> <span style="color:red;">*</span>
                </label>
                <input type="text" id="member_role" name="member_role" value="<?php echo esc_attr($role); ?>" class="widefat" placeholder="e.g. Executive Director, Head of Health, Programs Lead" style="height: 36px;" />
            </p>

            <p style="margin: 0;">
                <label for="menu_order_field" style="display: block; font-weight: 600; margin-bottom: 5px;">
                    <span class="dashicons dashicons-sort" style="vertical-align: middle; color: #e06000;"></span> <?php _e('Display Order / Priority:', 'limadia-entity-foundation-v1'); ?>
                </label>
                <input type="number" id="menu_order_field" name="menu_order_field" value="<?php echo esc_attr($post->menu_order); ?>" class="widefat" min="0" step="1" placeholder="1" style="height: 36px;" />
                <span class="description" style="color: #666; font-size: 12px;"><?php _e('Lower number = higher priority (1 for CEO, 2, 3, etc.)', 'limadia-entity-foundation-v1'); ?></span>
            </p>
        </div>

        <p style="margin: 0;">
            <label for="member_bio" style="display: block; font-weight: 600; margin-bottom: 5px;">
                <?php _e('Short Bio / Description (displayed underneath picture):', 'limadia-entity-foundation-v1'); ?>
            </label>
            <textarea id="member_bio" name="member_bio" rows="4" class="widefat" placeholder="Enter a brief summary of the member's background, expertise, and contribution to the foundation..."><?php echo esc_textarea($bio); ?></textarea>
            <span class="description" style="color: #666; font-size: 12px;"><?php _e('Tip: If left blank, the main post editor content will be used as a fallback.', 'limadia-entity-foundation-v1'); ?></span>
        </p>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <p style="margin: 0;">
                <label for="member_email" style="display: block; font-weight: 600; margin-bottom: 5px;">
                    <?php _e('Email Address:', 'limadia-entity-foundation-v1'); ?>
                </label>
                <input type="email" id="member_email" name="member_email" value="<?php echo esc_attr($email); ?>" class="widefat" placeholder="e.g. member@limadiafoundation.org" style="height: 36px;" />
            </p>

            <p style="margin: 0;">
                <label for="member_phone" style="display: block; font-weight: 600; margin-bottom: 5px;">
                    <?php _e('Phone Number (optional):', 'limadia-entity-foundation-v1'); ?>
                </label>
                <input type="text" id="member_phone" name="member_phone" value="<?php echo esc_attr($phone); ?>" class="widefat" placeholder="e.g. +233 59 580 3700" style="height: 36px;" />
            </p>
        </div>

        <h4 style="margin: 10px 0 0 0; padding-bottom: 5px; border-bottom: 1px solid #ddd; font-weight: 600;">
            <?php _e('Social & Professional Links', 'limadia-entity-foundation-v1'); ?>
        </h4>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <p style="margin: 0;">
                <label for="member_linkedin" style="display: block; font-weight: 600; margin-bottom: 5px;">
                    <span class="dashicons dashicons-linkedin" style="vertical-align: middle; color: #0077b5;"></span> <?php _e('LinkedIn URL:', 'limadia-entity-foundation-v1'); ?>
                </label>
                <input type="url" id="member_linkedin" name="member_linkedin" value="<?php echo esc_attr($linkedin); ?>" class="widefat" placeholder="https://linkedin.com/in/username" style="height: 36px;" />
            </p>

            <p style="margin: 0;">
                <label for="member_twitter" style="display: block; font-weight: 600; margin-bottom: 5px;">
                    <span class="dashicons dashicons-twitter" style="vertical-align: middle; color: #1da1f2;"></span> <?php _e('Twitter / X URL:', 'limadia-entity-foundation-v1'); ?>
                </label>
                <input type="url" id="member_twitter" name="member_twitter" value="<?php echo esc_attr($twitter); ?>" class="widefat" placeholder="https://x.com/username" style="height: 36px;" />
            </p>

            <p style="margin: 0;">
                <label for="member_facebook" style="display: block; font-weight: 600; margin-bottom: 5px;">
                    <span class="dashicons dashicons-facebook-alt" style="vertical-align: middle; color: #3b5998;"></span> <?php _e('Facebook URL:', 'limadia-entity-foundation-v1'); ?>
                </label>
                <input type="url" id="member_facebook" name="member_facebook" value="<?php echo esc_attr($facebook); ?>" class="widefat" placeholder="https://facebook.com/username" style="height: 36px;" />
            </p>

            <p style="margin: 0;">
                <label for="member_instagram" style="display: block; font-weight: 600; margin-bottom: 5px;">
                    <span class="dashicons dashicons-instagram" style="vertical-align: middle; color: #e1306c;"></span> <?php _e('Instagram URL:', 'limadia-entity-foundation-v1'); ?>
                </label>
                <input type="url" id="member_instagram" name="member_instagram" value="<?php echo esc_attr($instagram); ?>" class="widefat" placeholder="https://instagram.com/username" style="height: 36px;" />
            </p>
        </div>
    </div>
    <?php
}

/**
 * Save Meta Box Data
 */
function save_team_member_details_meta($post_id) {
    if (!isset($_POST['team_member_details_nonce']) || !wp_verify_nonce($_POST['team_member_details_nonce'], 'save_team_member_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save menu_order directly
    if (isset($_POST['menu_order_field'])) {
        $order = intval($_POST['menu_order_field']);
        global $wpdb;
        $wpdb->update(
            $wpdb->posts,
            array('menu_order' => $order),
            array('ID' => $post_id),
            array('%d'),
            array('%d')
        );
        clean_post_cache($post_id);
    }

    $fields = array(
        'member_role'      => 'sanitize_text_field',
        'member_bio'       => 'sanitize_textarea_field',
        'member_email'     => 'sanitize_email',
        'member_phone'     => 'sanitize_text_field',
        'member_linkedin'  => 'esc_url_raw',
        'member_twitter'   => 'esc_url_raw',
        'member_facebook'  => 'esc_url_raw',
        'member_instagram' => 'esc_url_raw',
    );

    foreach ($fields as $field => $sanitizer) {
        $meta_key = '_' . $field;
        if (isset($_POST[$field])) {
            $value = call_user_func($sanitizer, $_POST[$field]);
            update_post_meta($post_id, $meta_key, $value);
        } else {
            delete_post_meta($post_id, $meta_key);
        }
    }
}
add_action('save_post_team_member', 'save_team_member_details_meta');

/**
 * Custom Admin List Columns for Team Members
 */
function set_team_member_columns($columns) {
    $custom_columns = array();
    $custom_columns['cb']          = $columns['cb'];
    $custom_columns['thumbnail']   = __('Photo', 'limadia-entity-foundation-v1');
    $custom_columns['title']       = __('Name', 'limadia-entity-foundation-v1');
    $custom_columns['member_role'] = __('Role / Designation', 'limadia-entity-foundation-v1');
    $custom_columns['order']       = __('Order / Position', 'limadia-entity-foundation-v1');
    $custom_columns['email']       = __('Email', 'limadia-entity-foundation-v1');
    $custom_columns['date']        = $columns['date'];
    return $custom_columns;
}
add_filter('manage_team_member_posts_columns', 'set_team_member_columns');

function render_team_member_custom_column($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(50, 50), array('style' => 'width: 50px; height: 50px; object-fit: cover; border-radius: 4px;'));
            } else {
                echo '<span style="color: #999; font-size: 12px;">' . __('No photo', 'limadia-entity-foundation-v1') . '</span>';
            }
            break;
        case 'member_role':
            $role = get_post_meta($post_id, '_member_role', true);
            echo !empty($role) ? '<strong style="color: #e06000;">' . esc_html($role) . '</strong>' : '<span style="color:#aaa;">—</span>';
            break;
        case 'email':
            $email = get_post_meta($post_id, '_member_email', true);
            echo !empty($email) ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '<span style="color:#aaa;">—</span>';
            break;
        case 'order':
            $post = get_post($post_id);
            echo '<span style="display: inline-block; background: #f0f0f1; border: 1px solid #c3c4c7; color: #1d2327; padding: 2px 9px; border-radius: 4px; font-weight: 700; font-size: 12px;">#' . esc_html($post->menu_order) . '</span>';
            break;
    }
}
add_action('manage_team_member_posts_custom_column', 'render_team_member_custom_column', 10, 2);

/**
 * Make Order Column Sortable in Admin List
 */
function set_team_member_sortable_columns($columns) {
    $columns['order']       = 'menu_order';
    $columns['member_role'] = 'member_role';
    return $columns;
}
add_filter('manage_edit-team_member_sortable_columns', 'set_team_member_sortable_columns');

/**
 * Default Admin List Table to Sort by menu_order
 */
function set_team_member_admin_default_order($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    if ($query->get('post_type') === 'team_member' && !isset($_GET['orderby'])) {
        $query->set('orderby', array('menu_order' => 'ASC', 'date' => 'ASC'));
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'set_team_member_admin_default_order');

/**
 * Add Duplicate Row Action for Team Members
 */
function add_duplicate_team_member_link($actions, $post) {
    if ($post->post_type === 'team_member') {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=duplicate_team_member&post=' . $post->ID, 'duplicate_team_member_' . $post->ID) . '" title="' . esc_attr__('Duplicate this team member profile', 'limadia-entity-foundation-v1') . '">' . __('Duplicate', 'limadia-entity-foundation-v1') . '</a>';
    }
    return $actions;
}
add_filter('post_row_actions', 'add_duplicate_team_member_link', 10, 2);

function duplicate_team_member_post() {
    if (!isset($_GET['post']) || !isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'duplicate_team_member_' . $_GET['post'])) {
        wp_die(__('Security check failed.', 'limadia-entity-foundation-v1'));
    }

    $post_id = absint($_GET['post']);
    $post    = get_post($post_id);

    if ($post && $post->post_type === 'team_member') {
        $new_post = array(
            'post_title'    => $post->post_title . ' (Copy)',
            'post_content'  => $post->post_content,
            'post_status'   => 'draft',
            'post_excerpt'  => $post->post_excerpt,
            'post_type'     => 'team_member',
            'post_author'   => get_current_user_id(),
            'menu_order'    => $post->menu_order,
        );

        $new_post_id = wp_insert_post($new_post);

        // Duplicate meta fields
        $meta_fields = get_post_meta($post_id);
        foreach ($meta_fields as $key => $values) {
            foreach ($values as $value) {
                update_post_meta($new_post_id, $key, $value);
            }
        }

        // Duplicate featured image if exists
        $thumbnail_id = get_post_thumbnail_id($post_id);
        if ($thumbnail_id) {
            set_post_thumbnail($new_post_id, $thumbnail_id);
        }

        wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
        exit;
    }
}
add_action('admin_action_duplicate_team_member', 'duplicate_team_member_post');
