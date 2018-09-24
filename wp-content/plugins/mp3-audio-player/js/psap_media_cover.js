/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){
 
    // Instantiates the variable that holds the media library frame.
    var song_frame_cover;
 
    // Runs when the image button is clicked.
    //$('.song-button').click(function(e){
	$(document).on('click', '.song-cover-button' , function(e){
		
        // Prevents the default action from occuring.
        e.preventDefault();
		target = e.target || e.srcElement;
		song_id = target.id;

        // If the frame already exists, re-open it.
        if ( song_frame_cover ) {
            song_frame_cover.open();
            return;
        }

        // Sets up the media library frame
        song_frame_cover = wp.media.frames.song_frame_cover = wp.media({
            title: psap_media_cover_js.title,
            button: { text:  psap_media_cover_js.button },
            library: { type: 'image' },
			multiple: false
        });

        // Runs when an image is selected.
        song_frame_cover.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = song_frame_cover.state().get('selection').first().toJSON();
 
            // Sends the attachment URL to our custom image input field.

			$('#song_cover_' + song_id).val(media_attachment.url);
			delete target;
			delete song_id;
        });
 
        // Opens the media library frame.
        song_frame_cover.open();
    });
});