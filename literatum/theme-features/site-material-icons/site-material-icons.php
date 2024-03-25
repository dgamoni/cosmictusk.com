<?php
/**
 * Add a little firm/copyright text for the site in settings -> general
 *
 */









/**
* Devuelve true si esta activa la opcion de material icons
*/
function KTT_is_material_icons_active() {
  return true;
	return get_option(ktt_var_name('material_icons'));
}



/**
* Funcion para cargar la libreria google fonto de material icons
*/
function KTT_load_material_icons_font() {
	wp_enqueue_style( THEME_TEXTDOMAIN . '-material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', false );
}
if (KTT_is_material_icons_active()) add_action( 'wp_enqueue_scripts', 'KTT_load_material_icons_font', 1, 1 );



// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add page to theme options

				$args = array();
				$args['id'] = ktt_var_name('general-page');
				$args['page_title'] = 'General';
				$args['page_description'] = '';
				$args['menu_title'] = 'General';
				$args['menu_order'] = 1;
				$args['parent'] = 'theme-options';

				//$new_admin_submenu = new KTT_admin_submenu($args);



				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('material_icons');
				$args['option_name']            = __('Material Icons', THEME_TEXTDOMAIN);
				$args['option_label']           = __('Active material icons.', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Check this option to active material icons in the site.', THEME_TEXTDOMAIN) . '<br>' . 'https://material.io/icons/';
				$args['option_type']            = 'checkbox';
				$args['option_default']         = true;
				$args['option_order']						= 4;
				$args['option_page']            = ktt_var_name('general-page');


				//$KTT_new_setting = new KTT_new_setting($args);

}


?>
