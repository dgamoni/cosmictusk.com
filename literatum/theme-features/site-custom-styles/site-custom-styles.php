<?php
/**
 * Custom styles feature
 * v1.1
 *
 */





/**
* Esta función se encarga de extraer la lista de handles de librerias css que estan
* pendientes para que se carguen en una pagina date_date_set
*/
function KTT_get_page_style_handles($page_id = '') {

		/**
		* Si es una pagina de administracion salimos de aqui
		*/
		//if (is_admin()) return;

		/**
		* Si no se ha indicado una id de pagina entonces obtenemos la actual
		*/
		if (!$page_id) {
			global $post;
			if ($post) $page_id = $post->ID;
		}

		/**
		* En result vamos a ir formando el resultado
		*/
		$result = array();

		/**
		* Por defecto cargamos los styles que hay en cola
		*/
		global $wp_styles;
		if ($wp_styles) $result = $wp_styles->queue;

		/**
		* Aplicamos el filtro que nos permitira cambiar el array desde una función exterior
		*/
		$result = apply_filters('KTT_get_page_style_handles', $result, $page_id);

		/**
		* Por utlimo devolvemos el resutlado
		*/
		return $result;
}


/**
* Con este hook nos aseguramos de que las librerias extra esten incluidas en el
* array de handles de styles de la pagina. Le damos una prioridad de 50 para asegurarnos
* de que se ejecuta detras de cualquiera otra action. Las action o filters que tengan
* una prioridad mas alta podrian sobreescribir estas librerias extra
*/
function KTT_add_extra_styles_to_custom_page_styles_handles($handles, $page_id) {

		/**
		* Invocamos las wp_styles
		*/
		global $wp_styles;

		/**
		* Itineramos por cada una de las librerias registradas y nos quedamos con
		* las que empiecen por extra-style-
		*/
		if ($wp_styles && $wp_styles->registered) foreach (array_keys($wp_styles->registered) as $style_handle) {

				/**
				* Si el handle contiene la string "extra-style-" significa que es una style
				* extra, por lo tanto la añadimos a la listas
				*/
				if (strpos($style_handle, 'extra-style-') !== false)  $handles[] = $style_handle;
		}


		/**
		* Por ultimo devolvemos la lista de handles, modificada o no.
		*/
		return $handles;

}
add_filter('KTT_get_page_style_handles', 'KTT_add_extra_styles_to_custom_page_styles_handles', 50, 2);



/**
* Esta funcion se encarga de interceptar el hook que imprime los styles y sustituit los styles
* en cola por defecto por los que haya configurados para la página actual
*/
function KTT_print_custom_page_style_files() {
	global $wp_styles;
	if ($wp_styles) $wp_styles->queue = KTT_get_page_style_handles();
}
add_action( 'wp_print_styles', 'KTT_print_custom_page_style_files', 1 );






/**
* Este hook se encarga de añadir las librerias extra a la lista de enqueue styles
* así se incluiran en el theme y despues podran ser accesibles desde la funciones
* que se encargan de combinar librerias
*/
function KTT_combine_css_enqueue_extra_style_files() {

		/**
		* Obtenemos la lista de styles extra_css, del footer y del header.
		*/
		$extra_styles = get_option(ktt_var_name('custom_styles_extra_styles'));
		if (!is_array($extra_styles)) $extra_styles = (array)$extra_styles;

		/**
		* Si no hay files salimos de aqui
		*/
		if ( !$extra_styles) return;


		/**
		* Itineramos por cada extra style
		*/
		foreach ($extra_styles as $style ) {

				/**
				* Si no es una url válida seguimos con otra
				*/
				if (filter_var($style, FILTER_VALIDATE_URL) === FALSE)  continue;

				/**
				* Ponemos el file en cola
				*/
				$style_name = 'extra-style-' . basename($style);
				wp_register_style( $style_name, $style , '', '', 'all' );
				wp_enqueue_style( $style_name,  $style, '', '', 'all' );

		}


}
add_action( 'wp_enqueue_styles', 'KTT_combine_css_enqueue_extra_style_files', 99 );







/**
* Esta funcion se encarga de obtener el codigo extra javastyle para el footer
*/
function KTT_get_custom_style_code() {

		/**
		* En result vamos creando la salida
		*/
		$result = '';

		/**
		* Obtenemos el codigo extra_code
		*/
		$result .= @get_option(ktt_var_name('custom_style_extra_code'));

		/**
		* Devolvemos el resultado
		*/
		return $result;

}

/**
* Esta funcion se encarga de añadir un codigo style extra
* si esta configurado asi
*/
function KTT_add_custom_style_code_to_site($current_code) {

		/**
		* Obtenemos código extra
		*/
		$extra_code = KTT_get_custom_style_code();

		/**
		* Si hay codigo extra lo añadimos al custom css del sitio
		*/
		if ($extra_code) $current_code .= $extra_code;

		/**
		* Devolvemos el current_code modificado
		*/
		return $current_code;

}
add_action('KTT_add_site_custom_css', 'KTT_add_custom_style_code_to_site', 5, 1);





// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


			// add page to theme options

			$args = array();
			$args['id'] = ktt_var_name('custom-styles-page');
			$args['page_title'] = __('Custom styles',THEME_TEXTDOMAIN);
			$args['page_description'] = __("Custom options related with site's styles", THEME_TEXTDOMAIN);
			$args['menu_title'] = __('Custom styles', THEME_TEXTDOMAIN);
			$args['menu_order'] = 15;
			$args['parent'] = 'theme-options';

			$new_admin_submenu = new KTT_admin_submenu($args);





			// add option to admin panel

			$args                           = array();
			$args['option_id']              = ktt_var_name('custom_styles_extra_styles');
			$args['option_name']            = __('Extra styles', THEME_TEXTDOMAIN);
			$args['option_label']           = __('', THEME_TEXTDOMAIN);
			$args['option_placeholder']			= __('Insert style file url', THEME_TEXTDOMAIN);
			$args['option_description']     = __("You can add extra style files to the queue. This extra files will be added in the head of the page.", THEME_TEXTDOMAIN);
			$args['option_type']            = 'multiple_text';
			$args['option_default'] 				= '';
			$args['option_order'] 					= 4;
			$args['option_page']            = ktt_var_name('custom-styles-page');

			$KTT_new_setting = new KTT_new_setting($args);





			// add option to admin panel

			$args                           = array();
			$args['option_id']              = ktt_var_name('custom_style_extra_code');
			$args['option_name']            = __('Extra css code', THEME_TEXTDOMAIN);
			$args['option_label']           = __('', THEME_TEXTDOMAIN);
			$args['option_description']     = __("This extra css code will appear in the head of the page, just after the style links.", THEME_TEXTDOMAIN);
			$args['option_type']            = 'wp_editor';
			$args['option_type_vars'] 			= array(
																					'wpautop' => false,
																					'media_buttons' => false,
																					'textarea_name' => ktt_var_name('custom_style_extra_code'),
																					'textarea_rows' => 20,
																					'teeny' 	=> false,
																					'quicktags' => false,
																					'tinymce' => false,
																			);
			$args['option_default'] 				= '';
			$args['option_order'] 					= 5;
			$args['option_page']            = ktt_var_name('custom-styles-page');

			//$KTT_new_setting = new KTT_new_setting($args);






}
