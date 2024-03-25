<?php
/**
 * background image for users.
 *
 */





/**
* Esta funcion se encarga de mostrar el input en la pagina de administracion
* de edicion de usuario
*/
function KTT_add_user_template( $user ) {

    /**
    * Los subscribers nanay
    */
    if ( current_user_can( 'subscriber' ) )
      return FALSE;

    /**
    * Obtenemos la lista completa de templates que pueden usarse
    * en los perfiles de user
    */
    $templates = KTT_get_theme_templates_by_type('user');

    /**
    * Obtenemos la template que debe tener el user
    */
    $template_id = KTT_get_user_template_id($user->ID);


    ?>

  	<table class="form-table">
  		<tr>
  			<th>
  				<label for="address"><?php _e('Profile template', THEME_TEXTDOMAIN); ?>
  			</label></th>
  			<td>

  					<select name="<?php echo ktt_var_name('user_template');?>">
              <?php foreach ($templates as $template) {?>
                <option <?php selected($template->id, $template_id);?> value="<?php echo $template->id;?>"><?php echo $template->name;?></option>
              <?php } ?>
            </select>

  				<p class="description"><?php _e('Select a template to use in the profile page of this user.', THEME_TEXTDOMAIN); ?></p>

  			</td>
  		</tr>
  	</table>
<?php }







function KTT_save_user_template( $user_id ) {

    	  if ( !current_user_can( 'edit_user', $user_id ) ) return FALSE;
        update_user_meta( $user_id, ktt_var_name('user_template'), $_POST[ktt_var_name('user_template')] );

}

add_action( 'show_user_profile', 'KTT_add_user_template' );
add_action( 'edit_user_profile', 'KTT_add_user_template' );

add_action( 'personal_options_update', 'KTT_save_user_template' );
add_action( 'edit_user_profile_update', 'KTT_save_user_template' );
