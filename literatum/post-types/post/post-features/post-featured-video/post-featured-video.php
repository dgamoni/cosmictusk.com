<?php
/**
 * Add a new field in the post editor to add photo credit for featured images.
 *
 */




// return true to enable the photo credit feature in the theme
function KTT_post_featured_video_enabled() {
	return true;
}







/**
* Creation of the metabox_id with the hyper-amazing KTT Framework
*/
$args = array();
$args['metabox_id'] 					= 	'post_featured_video';
$args['metabox_name']					= 	__("Featured video", THEME_TEXTDOMAIN);
$args['metabox_post_type'] 		= 	'post';
$args['metabox_vars'] 				= 	array(
                                      ktt_var_name('post_featured_video')
                                  );
$args['metabox_callback']			= 	'KTT_featured_video_meta_callback';
$args['metabox_context']			= 	'side';
$args['metabox_priority']			= 	'default';
$metabox = new KTT_new_metabox($args);


// META BOX FORM
function KTT_featured_video_meta_callback( $post ) {

    $featured_video = $post->post_featured_video;
    $value = '';
    if (isset($featured_video['src'])) $value = $featured_video['src'];

    ?>



            <div <?php if (!$value){?> style="display:none"<?php } ?> class="video-cover-preview">

                <video
								id="video-preview"
								class="video-preview-frame"
								controls
								preload
								width="100%">
                    <source src="<?php echo $value;?>" type="video/mp4">
                </video>



                <p><a onclick="quit_featured_video()" style="text-decoration:underline;cursor:pointer"><?php _e('Remove featured video', THEME_TEXTDOMAIN);?></a></p>

            </div>


            <div <?php if ($value){?>style="display:none"<?php } ?> class="video-cover-form">

                <p class="media-library-mode-message"><?php _e('Select a video from the Media library or upload a new one.',THEME_TEXTDOMAIN);?> <?php _e('Also you can use a YouTube video url.',THEME_TEXTDOMAIN);?></p>

                <p class="use-url-mode-message" style="display:none"><?php _e('Introduce the URL of the video file or a YouTube video url.',THEME_TEXTDOMAIN);?></p>
                <textarea
                type="text"
                onchange="validate_video_input(this)"
                class="normal-text"
                id="upload-video-video-cover"
                name=""
                style="display:none;width:100%"
                rows="4"
                ><?php echo $value;?></textarea>



                <span
                class="button-primary button"
                id="upload-button-video-cover"
                >
                <?php _e('Select from library', THEME_TEXTDOMAIN);?>
                </span>

                <a onclick="use_url_mode()" class="button"><?php _e('Use URL');?></a>

                <p class="video-cover-error" style="color:#e74c3c"></p>

                <p style=""><b><?php _e('Available formats:',THEME_TEXTDOMAIN);?></b> mp4, ogg, webm, m4v, wmv, mov, ogv.</p>

            </div>


						<input
						type="hidden"
						class="regular-text"
						id="upload-video-video-cover-real"
						name="<?php echo ktt_var_name('post_featured_video');?>[src]"
						value="<?php echo $value;?>">








                <script>

                        // Uploading files
                        var file_frame;

                          jQuery('#upload-button-video-cover').live('click', function( event ){

                            event.preventDefault();

                            button = jQuery(this);


                            // Create the media frame.
                            file_frame = wp.media.frames.file_frame = wp.media({
                              title: jQuery( this ).data( 'uploader_title' ),
                              button: {
                                text: jQuery( this ).data( 'uploader_button_text' ),
                              },
                              multiple: false  // Set to true to allow multiple files to be selected
                            });

                            // When an image is selected, run a callback.
                            file_frame.on( 'select', function() {
                              // We set multiple to false so only get one image from the uploader
                              attachment = file_frame.state().get('selection').first().toJSON();
                              jQuery('#upload-video-video-cover').val(attachment.url);
                              jQuery('#upload-video-video-cover').change();
                              media_library_mode()

                            });

                            // Finally, open the modal
                            file_frame.open();
                          });


                        function validate_video_input(input) {


                            if (!is_video_file(input.value) && !is_youtube_file(input.value)) {
                                    jQuery('.video-cover-error').html('<?php _e('The introduced URL does not seem as a valid video file. Please, introduce a valid video file URL.',THEME_TEXTDOMAIN);?>');
                                    jQuery('#upload-video-video-cover-real').val('');
                                    return false;
                            }


                            jQuery('.video-cover-error').html('');
                            jQuery('#upload-video-video-cover-real').val(input.value);
                            put_featured_video(input.value)

                        }


                        function quit_featured_video() {

                            jQuery('.video-cover-preview').hide();
														jQuery('.video-cover-preview .video-preview-frame').hide();
                            jQuery('.video-cover-form').show();
                            jQuery('#upload-video-video-cover-real').val('');
                            jQuery('#upload-video-video-cover').val('');

                        }

                        function put_featured_video(file_string) {

                            jQuery('.video-cover-preview').show();
														jQuery('.video-preview-frame').hide();
                            jQuery('.video-cover-form').hide();

														/**
														* A la hora de mostrar el preview del video debemos comprobar que tipo de video es
														* y en baso a eso mostrar una preview y otra (iframe o video)
														*/
														if (is_video_file(file_string)) {
																jQuery('.video-cover-preview #video-preview').show().attr('src', file_string);
														} else if(is_youtube_file(file_string)) {
																//jQuery('.video-cover-preview #youtube-preview').remove();

																jQuery('<iframe width="auto" height="200" frameborder="0" allowfullscreen style="width:100%" class="video-preview-frame" id="youtube-preview"></iframe>')
															    .attr("src", "http://www.youtube.com/embed/" + get_youtube_video_code_id(file_string))
															    .prependTo(".video-cover-preview");

														}


                        }

												/**
												* Esta funcion se encarga de obtener el codigo del video de una url de youtube
												*/
												function get_youtube_video_code_id(youtube_url) {
														var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
	 													var match = youtube_url.match(regExp);
	 													return (match&&match[7].length==11)? match[7] : false;
												}


                        function is_youtube_file(file_string) {

														var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
														var match = file_string.match(regExp);
														if (match && match[2].length == 11) return true;
														else return false;

                        }


                        function is_video_file(file_string) {
                            valid = ['mp4', 'm4v', 'ogg', 'webm', 'avi', 'mov', 'ogv', 'mpg', 'wmv'];
                            ext = file_string.split('.').pop();

                            if(valid.indexOf(ext) != -1) return true;
                            return false;
                        }


                        function use_url_mode() {

                            jQuery('#upload-video-video-cover').show().val('');
                            jQuery('.use-url-mode-message').show()
                            jQuery('.media-library-mode-message').hide()

                        }

                        function media_library_mode() {
                            jQuery('#upload-video-video-cover').hide();
                            jQuery('.use-url-mode-message').hide()
                            jQuery('.media-library-mode-message').show()
                        }


												<?php if ($value) {?> put_featured_video('<?php echo $value;?>'); <?php } ?>


                    </script>
















            <script>

            jQuery(document).ready( function($) {
                // wp tabs
                $('.wp-tab-bar a').click(function(event){
                    event.preventDefault();
                    // Limit effect to the container element.
                    var context = $(this).parents('.wp-tab-bar').first().parent();
                    $('.wp-tab-bar li', context).removeClass('wp-tab-active');
                    $(this).parents('li').first().addClass('wp-tab-active');
                    $('.wp-tab-panel', context).hide();
                    $( $(this).attr('href'), context ).show();
                });
                // Make setting wp-tab-active optional.
                $('.wp-tab-bar').each(function(){
                    if ( $('.wp-tab-active', this).length )
                        $('.wp-tab-active', this).click();
                    else $('a', this).first().click();
                });
            });

            </script>


    <?php

}




/**
* Este hook se encarga de modificar la funcion que obtiene la url del video para sustutiirla con
* la url del video featured del post si este tiene uno configurado
*/
function KTT_replace_header_video_with_post_featured_video_url_in_single_pages($url) {


		/**
		* Si no estamos en una pagina single entonces nanay
		*/
		if (!is_single()) return $url;

		/**
		* Obtenemos el objeto completo
		*/
		global $post;
		if (isset($post->post_featured_video) && isset($post->post_featured_video['src']) && $post->post_featured_video['src']) return $post->post_featured_video['src'];

		/**
		* Si hemos llegado hasta qui devolvemos la url
		*/
		return $url;

}
add_filter('get_header_video_url', 'KTT_replace_header_video_with_post_featured_video_url_in_single_pages', 5, 1);




/**
* Esta funcion se encarga de marcar como activo el video header si estamos en un pagina
* single y el post tiene un video featured
*/
function KTT_set_active_video_header_for_single_page($value) {

		/**
		* Si no estamos en una pagina single entonces nanay
		*/
		if (!is_single()) return $value;

		/**
		* Si el post actuali tiene video configurado entonces devolvemos un true por aqui
		*/
		global $post;
		if (isset($post->post_featured_video) && isset($post->post_featured_video['src']) && $post->post_featured_video['src']) return true;

		/**
		* Por ultimo, si hemos llegado hasta aqui, devolvemos el value
		*/
		return $value;

}
add_filter('is_header_video_active', 'KTT_set_active_video_header_for_single_page', 5, 1);

?>
