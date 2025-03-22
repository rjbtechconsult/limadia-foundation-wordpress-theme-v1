<?php
function modify_slide_featured_image_label($content, $post_id) {
    $post = get_post($post_id);
    
    if ($post && get_post_type($post_id) === 'slide') {
        $content = str_replace('Set featured image', 'Upload Slide Image (1920 x 1280)', $content);
        $content = str_replace('Remove featured image', 'Remove Slide Image', $content);
    }
    
    return $content;
}
add_filter('admin_post_thumbnail_html', 'modify_slide_featured_image_label', 10, 2);

