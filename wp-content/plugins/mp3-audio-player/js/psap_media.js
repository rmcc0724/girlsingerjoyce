/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){
 
    // Instantiates the variable that holds the media library frame.
    var song_frame;
 
    // Runs when the image button is clicked.
    //$('.song-button').click(function(e){
	$(document).on('click', '.song-button' , function(e){
		
        // Prevents the default action from occuring.
        e.preventDefault();
		target = e.target || e.srcElement;
		song_id = target.id;

        // If the frame already exists, re-open it.
        if ( song_frame ) {
            song_frame.open();
            return;
        }

        // Sets up the media library frame
        song_frame = wp.media.frames.song_frame = wp.media({
            title: psap_media_js.title,
            button: { text:  psap_media_js.button },
            library: { type: 'audio' },
			multiple: false
        });

        // Runs when an image is selected.
        song_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = song_frame.state().get('selection').first().toJSON();
 
            // Sends the attachment URL to our custom image input field.

			$('#song_file_' + song_id).val(media_attachment.url);
			delete target;
			delete song_id;
        });
 
        // Opens the media library frame.
        song_frame.open();
    });
});