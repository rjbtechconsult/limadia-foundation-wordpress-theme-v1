<?php

function register_slide_cpt() {
    $labels = [
        'name'               => 'Slides',
        'singular_name'      => 'Slide',
        'menu_name'          => 'Slides',
        'name_admin_bar'     => 'Slide',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Slide',
        'new_item'           => 'New Slide',
        'edit_item'          => 'Edit Slide',
        'view_item'          => 'View Slide',
        'all_items'          => 'All Slides',
        'search_items'       => 'Search Slides',
        'not_found'          => 'No slides found.',
        'not_found_in_trash' => 'No slides found in Trash.',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'show_in_menu'       => true,
        'supports'           => ['title', 'thumbnail'],
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-images-alt2',
        'capability_type'    => 'post',
        'has_archive'        => false,
        'rewrite'            => ['slug' => 'slides'],
    ];

    register_post_type('slide', $args);
}
add_action('init', 'register_slide_cpt');

// Add Subtitle Meta Box
function add_slide_meta_boxes() {
    add_meta_box('slide_subtitle', 'Subtitle', 'slide_subtitle_callback', 'slide', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_slide_meta_boxes');

function slide_subtitle_callback($post) {
    $subtitle = get_post_meta($post->ID, '_slide_subtitle', true);
    echo '<input type="text" name="slide_subtitle" value="' . esc_attr($subtitle) . '" style="width:100%;" />';
}

// Save Subtitle
function save_slide_meta($post_id) {
    if (isset($_POST['slide_subtitle'])) {
        update_post_meta($post_id, '_slide_subtitle', sanitize_text_field($_POST['slide_subtitle']));
    }
}
add_action('save_post', 'save_slide_meta');

// Enforce Image Size Constraint
function enforce_slide_image_size($file) {
    if (isset($_REQUEST['post_id']) && get_post_type($_REQUEST['post_id']) === 'slide') {
        $image = getimagesize($file['tmp_name']);
        if ($image) {
            $width  = $image[0];
            $height = $image[1];
            if ($width != 1920 || $height != 1280) {
                $file['error'] = 'Slide images must be exactly 1920x1280 pixels.';
            }
        }
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'enforce_slide_image_size');
