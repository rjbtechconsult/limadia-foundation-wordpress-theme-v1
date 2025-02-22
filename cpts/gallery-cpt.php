<?php

function register_gallery_cpt() {
    $labels = array(
        'name'          => __('Galleries', 'limadia-entity-foundation-v1'),
        'singular_name' => __('Gallery', 'limadia-entity-foundation-v1'),
        'menu_name'     => __('Gallery'),
        'add_new'       => __('Add New Gallery'),
        'add_new_item'  => __('Add New Gallery'),
        'edit_item'     => __('Edit Gallery'),
        'new_item'      => __('New Gallery'),
        'view_item'     => __('View Gallery'),
        'all_items'     => __('All Galleries'),
    );

    $args = array(
        'label'         => __('Gallery', 'limadia-entity-foundation-v1'),
        'labels'        => $labels,
        'public'        => true,
        'menu_icon'     => 'dashicons-format-gallery',
        'supports'      => array('title', 'thumbnail'),
        'menu_position' => 5,
    );

    register_post_type('gallery', $args);
}
add_action('init', 'register_gallery_cpt');

function add_gallery_meta_box() {
    add_meta_box('gallery_meta', 'Gallery Images', 'gallery_meta_box_callback', 'gallery', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_gallery_meta_box');

function gallery_meta_box_callback($post) {
    $gallery_images = get_post_meta($post->ID, 'gallery_images', true);
    ?>
    <div id="gallery_container">
        <ul id="gallery_images_list">
            <?php
            if (!empty($gallery_images)) {
                $image_ids = explode(',', $gallery_images);
                foreach ($image_ids as $image_id) {
                    echo '<li class="gallery-image">';
                    echo wp_get_attachment_image($image_id, 'thumbnail');
                    echo '<span class="remove-image" style="cursor:pointer;color:red;">Remove</span>';
                    echo '<input type="hidden" name="gallery_images[]" value="' . esc_attr($image_id) . '">';
                    echo '</li>';
                }
            }
            ?>
        </ul>
        <input type="hidden" id="gallery_images" name="gallery_images" value="<?php echo esc_attr($gallery_images); ?>">
        <button type="button" class="button" id="upload_gallery_images">Add Images</button>
    </div>
    <script>
        jQuery(document).ready(function($) {
            var mediaUploader;

            $('#upload_gallery_images').click(function(e) {
                e.preventDefault();
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Images',
                    button: { text: 'Add to Gallery' },
                    multiple: true
                });

                mediaUploader.on('select', function() {
                    var selection = mediaUploader.state().get('selection');
                    var imageIds = $('#gallery_images').val() ? $('#gallery_images').val().split(',') : [];
                    selection.map(function(attachment) {
                        attachment = attachment.toJSON();
                        imageIds.push(attachment.id);
                        $('#gallery_images_list').append('<li class="gallery-image" data-id="'+attachment.id+'">' +
                            '<img src="'+attachment.url+'" style="width:100px;">' +
                            '<span class="remove-image" style="cursor:pointer;color:red;">Remove</span>' +
                            '<input type="hidden" name="gallery_images[]" value="'+attachment.id+'">' +
                            '</li>');
                    });

                    $('#gallery_images').val(imageIds.join(','));
                });

                mediaUploader.open();
            });

            $('#gallery_images_list').on('click', '.remove-image', function() {
                var imageItem = $(this).closest('.gallery-image');
                var imageId = imageItem.attr('data-id');
                
                // Remove image from UI
                imageItem.remove();

                // Update the hidden input field to exclude the removed image
                var imageIds = $('#gallery_images').val().split(',');
                imageIds = imageIds.filter(id => id !== imageId);
                $('#gallery_images').val(imageIds.join(','));
            });
        });

    </script>
    <style>
        #gallery_images_list {
            display: flex;
            flex-wrap: wrap;
        }
        .gallery-image {
            margin: 5px;
            position: relative;
        }
        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #fff;
            padding: 2px 5px;
            border-radius: 3px;
        }
    </style>
    <?php
}

function save_gallery_images($post_id) {
    if (isset($_POST['gallery_images'])) {
        $new_images = array_filter(explode(',', sanitize_text_field($_POST['gallery_images']))); // Remove empty values

        if (!empty($new_images)) {
            update_post_meta($post_id, 'gallery_images', implode(',', $new_images)); // Save only the current images
        } else {
            delete_post_meta($post_id, 'gallery_images'); // If no images, remove from DB
        }
    }
}
add_action('save_post', 'save_gallery_images');

?>