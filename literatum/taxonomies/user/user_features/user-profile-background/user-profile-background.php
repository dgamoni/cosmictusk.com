<?php
/**
 * background image for authors.
 *
 */



function KTT_add_profile_background_image( $user ) {


  if ( current_user_can( 'subscriber' ) )
    return FALSE;

  $var_id = ktt_var_name('profile_background_image');

  $value = get_user_meta($user->ID, ktt_var_name('profile_background_image'), true);

  $image = get_post($value);
  if (!$image) {
      $value = '';
  } else {
      $image_src = wp_get_attachment_url( $value );
  }


  wp_enqueue_media();
  wp_enqueue_script('media-upload');
?>

	<table class="form-table">
		<tr>
			<th>
				<label for="address"><?php _e('Profile background', THEME_TEXTDOMAIN); ?>
			</label></th>
			<td>

					<div id="upload-field-<?php echo $var_id;?>">

                        <div  style="margin-bottom:20px;<?php if (!$value) {?>display:none;<?php } ?>" class="show-on-image">

                            <img id="uploaded-image-<?php echo $var_id;?>" style="display:block;max-height:160px;max-width:500px;" src="<?php echo $image_src;?>">

                        </div>

                       <span
                       data-uploader_title="<?php echo __('Profile background image', THEME_TEXTDOMAIN);?>"
                       id="upload-button-<?php echo $var_id;?>"
                       class="button button-primary">
                            <?php _e('Select image', THEME_TEXTDOMAIN);?>
                       </span>


                	     <span
                       <?php if (!$value) {?>style="display:none;"<?php } ?>
                       id="remove-button-<?php echo $var_id;?>"
                       onclick="jQuery('#upload-field-<?php echo $var_id;?> .show-on-image').hide();jQuery('#upload-image-<?php echo $var_id;?>').val('');"
                       class="show-on-image button button-secondary">
                            <?php _e('Remove',THEME_TEXTDOMAIN);?>
                       </span>



                        <input
                        id="upload-image-<?php echo $var_id;?>"
                        type="hidden"
                        id="<?php echo $var_id ;?>"
                        name="<?php echo $var_id ;?>"
                        value="<?php echo $value;?>">




                    </div>

                	<script>

                    // Uploading files
                    var file_frame;

                      jQuery('#upload-button-<?php echo $var_id;?>').live('click', function( event ){

                        event.preventDefault();

                        button = jQuery(this);

                        // If the media frame already exists, reopen it.
                        /*if ( file_frame ) {
                          // Open frame
                          file_frame.open();
                          return;
                        } */

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
                          jQuery('#upload-image-<?php echo $var_id;?>').val(attachment.id);

                          jQuery('#uploaded-image-<?php echo $var_id;?>').attr('src', attachment.url);

                          jQuery('#upload-field-<?php echo $var_id;?> .show-on-image').show();

                        });

                        // Finally, open the modal
                        file_frame.open();
                      });

					</script>


				<p class="description"><?php _e('Select or upload an image to show as profile background.', THEME_TEXTDOMAIN); ?></p>

			</td>
		</tr>
	</table>
<?php }

function KTT_save_profile_background_image( $user_id ) {



  	if ( !current_user_can( 'edit_user', $user_id ) )
  		return FALSE;

  	update_user_meta( $user_id, ktt_var_name('profile_background_image'), $_POST[ktt_var_name('profile_background_image')] );

}

add_action( 'show_user_profile', 'KTT_add_profile_background_image' );
add_action( 'edit_user_profile', 'KTT_add_profile_background_image' );

add_action( 'personal_options_update', 'KTT_save_profile_background_image' );
add_action( 'edit_user_profile_update', 'KTT_save_profile_background_image' );
