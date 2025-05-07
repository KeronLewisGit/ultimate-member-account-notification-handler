jQuery(document).ready(function($){
    $('#anh_upload_button').on('click', function(e){
        e.preventDefault();
        var frame = wp.media({ title: 'Select Attachment', button: { text: 'Use this file' }, multiple: false });
        frame.on('select', function(){
            var att = frame.state().get('selection').first().toJSON();
            $('#anh_attachment_id').val(att.id);
            $('#anh_attachment_preview').html('<a href="'+att.url+'" target="_blank">'+att.filename+'</a>');
        }); frame.open();
    });
});
