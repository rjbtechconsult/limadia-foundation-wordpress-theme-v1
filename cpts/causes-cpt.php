<?php
function register_cause_post_type() {
    $args = array(
        'labels' => array(
            'name'          => 'Causes',
            'singular_name' => 'Cause'
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-heart', 
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'    => array('category') // Enable categories for Causes
    );
    register_post_type('cause', $args);
}
add_action('init', 'register_cause_post_type');

// Add featured cause meta box

function add_featured_cause_meta_box() {
    add_meta_box(
        'featured_cause_meta_box',
        'Featured Cause',
        'featured_cause_meta_box_callback',
        'cause', // Applies to Causes CPT
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'add_featured_cause_meta_box');

function featured_cause_meta_box_callback($post) {
    $featured = get_post_meta($post->ID, '_is_featured_cause', true);
    ?>
    <label>
        <input type="checkbox" name="is_featured_cause" value="1" <?php checked($featured, '1'); ?> />
        Mark as Featured
    </label>
    <?php
}

function save_featured_cause_meta($post_id) {
    if (isset($_POST['is_featured_cause'])) {
        update_post_meta($post_id, '_is_featured_cause', '1');
    } else {
        delete_post_meta($post_id, '_is_featured_cause');
    }
}
add_action('save_post', 'save_featured_cause_meta');

// Meta box for goals, raised, and goal percentage
function add_cause_meta_boxes() {
    add_meta_box(
        'cause_meta_box',
        'Cause Details',
        'cause_meta_box_callback',
        'cause',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_cause_meta_boxes');

function cause_meta_box_callback($post) {
    $goal   = get_post_meta($post->ID, '_cause_goal', true);
    $raised = get_post_meta($post->ID, '_cause_raised', true);
    $donors = get_post_meta($post->ID, '_cause_donors', true);
    ?>
    <p>
        <label><strong>Goal Amount ($):</strong></label>
        <input type="number" name="cause_goal" value="<?php echo esc_attr($goal); ?>" step="0.01" min="0" />
    </p>
    <p>
        <label><strong>Amount Raised ($):</strong></label>
        <input type="number" name="cause_raised" value="<?php echo esc_attr($raised); ?>" step="0.01" min="0" />
    </p>
    <p>
        <label><strong>Number of Donors:</strong></label>
        <input type="number" name="cause_donors" value="<?php echo esc_attr($donors); ?>" step="1" min="0" />
    </p>
    <?php
}

function save_cause_meta($post_id) {
    if (isset($_POST['cause_goal'])) {
        update_post_meta($post_id, '_cause_goal', sanitize_text_field($_POST['cause_goal']));
    }
    if (isset($_POST['cause_raised'])) {
        update_post_meta($post_id, '_cause_raised', sanitize_text_field($_POST['cause_raised']));
    }
    if (isset($_POST['cause_donors'])) {
        update_post_meta($post_id, '_cause_donors', sanitize_text_field($_POST['cause_donors']));
    }
}
add_action('save_post', 'save_cause_meta');


// Dubplicate the cause post type 
function add_duplicate_cause_link($actions, $post) {
    if ($post->post_type == 'cause') {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=duplicate_cause&post=' . $post->ID, 'duplicate_cause_' . $post->ID) . '" title="Duplicate this cause">Duplicate</a>';
    }
    return $actions;
}
add_filter('post_row_actions', 'add_duplicate_cause_link', 10, 2);

function duplicate_cause_post() {
    if (!isset($_GET['post']) || !isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'duplicate_cause_' . $_GET['post'])) {
        wp_die('Security check failed.');
    }

    $post_id = absint($_GET['post']);
    $post = get_post($post_id);

    if ($post && $post->post_type === 'cause') {
        $new_post = array(
            'post_title'    => $post->post_title . ' (Copy)',
            'post_content'  => $post->post_content,
            'post_status'   => 'draft',
            'post_excerpt'  => $post->post_excerpt,
            'post_type'     => 'cause',
            'post_author'   => get_current_user_id(),
        );

        $new_post_id = wp_insert_post($new_post);

        // Duplicate meta fields
        $meta_fields = get_post_meta($post_id);
        foreach ($meta_fields as $key => $values) {
            foreach ($values as $value) {
                update_post_meta($new_post_id, $key, $value);
            }
        }

         // ✅ Duplicate taxonomies (categories)
        $taxonomies = get_object_taxonomies($post->post_type);
        foreach ($taxonomies as $taxonomy) {
            $terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'ids'));
            if (!empty($terms)) {
                wp_set_object_terms($new_post_id, $terms, $taxonomy);
            }
        }

        // Redirect to edit screen
        wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
        exit;
    }
}
add_action('admin_action_duplicate_cause', 'duplicate_cause_post');

