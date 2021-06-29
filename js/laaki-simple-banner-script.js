$ = jQuery.noConflict();

jQuery(document).ready(function($){

    var mediaUploader;
	var btnUpload;
	var btnDelete;

	$('body').on('click', '.laaki-simple-banner-upload-button',function(e) {

		btnUpload = $(this);

		e.preventDefault();

		if (mediaUploader) {
			mediaUploader.open();
			return;
		}

		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
			text: 'Choose Image'
		}, multiple: false });

		mediaUploader.on('select', function() {

			var attachment = mediaUploader.state().get('selection').first().toJSON();
	
			btnUpload.prev().html("");
			btnUpload.prev().prepend('<img style="width:100%" src=' + attachment.url + '>');
			btnUpload.next().val(attachment.url).trigger('change');
			//console.log(btnUpload.prev())
			console.log(attachment.url)
		});

		mediaUploader.open();
	});

	$('body').on('click', '.laaki-simple-banner-delete-button',function(e) {		

		e.preventDefault();

		btnDelete = $(this);

		var conf = confirm("Delete the image?");

		if ( conf == false ) return;

		btnDelete.prev().prev().prev().html("");
		btnDelete.prev().val(null).trigger('change');
		btnDelete.hide();

	});

});