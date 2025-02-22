jQuery(document).ready(function($) {
    $('#gallery-upload-button').on('click', function(e) {
        e.preventDefault();
        var frame = wp.media({
            title: 'Select Images',
            multiple: true,
            library: { type: 'image' },
            button: { text: 'Use Selected Images' }
        });
        frame.on('select', function() {
            var selection = frame.state().get('selection');
            var ids = [];
            $('#gallery-preview').html('');
            selection.each(function(attachment) {
                ids.push(attachment.id);
                $('#gallery-preview').append('<img src="' + attachment.attributes.url + '" width="100" />');
            });
            $('#gallery_images').val(ids.join(','));
        });
        frame.open();
    });
});
