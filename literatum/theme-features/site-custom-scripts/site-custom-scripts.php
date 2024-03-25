<?php
/**
 * Custom scripts feature
 * v1.1
 *
 */





/**
* Esta función se encarga de extraer la lista de handles de librerias js que estan
* pendientes para que se carguen en una pagina
*/
function KTT_get_page_script_handles($page_id = '') {

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
		* Por defecto cargamos los scripts que hay en cola
		*/
		global $wp_scripts;
		if ($wp_scripts) $result = $wp_scripts->queue;

		/**
		* Aplicamos el filtro que nos permitira cambiar el array desde una función exterior
		*/
		$result = apply_filters('KTT_get_page_script_handles', $result, $page_id);

		/**
		* Por utlimo devolvemos el resutlado
		*/
		return $result;
}



/**
* Con este hook nos aseguramos de que las librerias extra esten incluidas en el
* array de handles de scripts de la pagina. Le damos una prioridad de 50 para asegurarnos
* de que se ejecuta detras de cualquiera otra action. Las action o filters que tengan
* una prioridad mas alta podrian sobreescribir estas librerias extra
*/
function KTT_add_extra_scripts_to_custom_page_scripts_handles($handles, $page_id) {

		/**
		* Invocamos las wp_scripts
		*/
		global $wp_scripts;

		/**
		* Itineramos por cada una de las librerias registradas y nos quedamos con
		* las que empiecen por extra-script-
		*/
		if ($wp_scripts && $wp_scripts->registered) foreach (array_keys($wp_scripts->registered) as $script_handle) {

				/**
				* Si el handle contiene la string "extra-script-" significa que es una script
				* extra, por lo tanto la añadimos a la listas
				*/
				if (strpos($script_handle, 'extra-script-') !== false)  $handles[] = $script_handle;
		}

		/**
		* Eliminamos duplicados
		*/
		$handles = array_unique($handles);


		/**
		* Por ultimo devolvemos la lista de handles, modificada o no.
		*/
		return $handles;

}
add_filter('KTT_get_page_script_handles', 'KTT_add_extra_scripts_to_custom_page_scripts_handles', 50, 2);



/**
* Esta funcion se encarga de interceptar el hook que imprime los scripts y sustituit los scripts
* en cola por defecto por los que haya configurados para la página actual
*/
function KTT_print_custom_page_script_files() {
	global $wp_scripts;
	if ($wp_scripts) $wp_scripts->queue = KTT_get_page_script_handles();
}
add_action( 'wp_print_scripts', 'KTT_print_custom_page_script_files', 1 );






/**
* Este hook se encarga de añadir las librerias extra a la lista de enqueue scripts
* así se incluiran en el theme y despues podran ser accesibles desde la funciones
* que se encargan de combinar librerias
*/
function KTT_combine_js_enqueue_extra_script_files() {

		/**
		* Obtenemos la lista de scripts extra_js, del footer y del header.
		*/
		$extra_footer_scripts = get_option(ktt_var_name('custom_scripts_extra_footer_scripts'));
		$extra_header_scripts = get_option(ktt_var_name('custom_scripts_extra_header_scripts'));
		if (!is_array($extra_footer_scripts)) $extra_footer_scripts = (array)$extra_footer_scripts;
		if (!is_array($extra_header_scripts)) $extra_header_scripts = (array)$extra_header_scripts;

		/**
		* Si no hay files salimos de aqui
		*/
		if (!$extra_footer_scripts && !$extra_header_scripts) return;

		/**
		* Cobinamos las dos listas
		*/
		$extra_scripts = array_merge($extra_footer_scripts, $extra_header_scripts);

		/**
		* Si no hay scripts extra entonces salimos de aqui
		*/
		if (!$extra_scripts) return;

		/**
		* Itineramos por cada extra script
		*/
		foreach ($extra_scripts as $script ) {


				/**
				* Indicamos si va al footer o no
				*/
				$in_footer = false;
				if (in_array($script, $extra_footer_scripts)) $in_footer = true;

				/**
				* Si no es una url válida seguimos con otra
				*/
				if (filter_var($script, FILTER_VALIDATE_URL) === FALSE)  continue;

				/**
				* Ponemos el file en cola
				*/
				$script_name = parse_url('extra-script-' . basename($script), PHP_URL_PATH);
				wp_register_script( $script_name, $script , '', '', $in_footer );
				wp_enqueue_script( $script_name,  $script, '', '', $in_footer );


		}


}
add_action( 'wp_enqueue_scripts', 'KTT_combine_js_enqueue_extra_script_files', 99 );







/**
* Esta funcion se encarga de obtener el codigo extra javascript para el footer
*/
function KTT_get_custom_footer_script_code() {

		/**
		* En result vamos creando la salida
		*/
		$result = '';

		/**
		* Obtenemos el codigo extra_code
		*/
		$result .= @get_option(ktt_var_name('custom_scripts_extra_footer_code'));

		/**
		* Devolvemos el resultado
		*/
		return $result;

}

/**
* Esta funcion se encarga de añadir un codigo javascript extra al footer
* si esta configurado asi
*/
function KTT_add_custom_footer_script_code($current_js) {

		/**
		* Obtenemos código extra
		*/
		$extra_code = KTT_get_custom_footer_script_code();

		/**
		* Si no hay código extra salimos de aquí.
		*/
		if (!$extra_code) return $current_js;

		/**
		* Al current_js le sumamos el extra code
		*/
		$current_js .= ';' . $extra_code;

		/**
		* La funcion devuelve el current_js modificado
		*/
		return $current_js;

}
add_action('KTT_add_site_custom_js_footer', 'KTT_add_custom_footer_script_code', 100, 1);


/**
* Este filter se encarga de añadir el codigo extra js del footer al footer combinado
*/
//function KTT_add_custom_footer_script_code_to_combined_footer($footer_content) {
//		return $footer_content . ';' . KTT_get_custom_footer_script_code();
//}
//add_filter('KTT_combine_js_footer_filter', 'KTT_add_custom_footer_script_code_to_combined_footer', 5, 1);







/**
* Esta funcion se encarga de obtener el codigo extra javascript para el footer
*/
function KTT_get_custom_header_script_code() {

		/**
		* En result vamos creando la salida
		*/
		$result = '';

		/**
		* Obtenemos el codigo extra_code
		*/
		$result .= @get_option(ktt_var_name('custom_scripts_extra_header_code'));

		/**
		* Devolvemos el resultado
		*/
		return $result;

}

/**
* Esta funcion se encarga de añadir un codigo javascript extra al footer
* si esta configurado asi
*/
function KTT_add_custom_header_script_code($current_js) {

			/**
			* Obtenemos código extra
			*/
			$extra_code = KTT_get_custom_header_script_code();

			/**
			* Si no hay código extra salimos de aquí.
			*/
			if (!$extra_code) return $current_js;

			/**
			* Al current_js le sumamos el extra code
			*/
			$current_js .= ';' . $extra_code;

			/**
			* La funcion devuelve el current_js modificado
			*/
			return $current_js;

}
add_action('KTT_add_site_custom_js_header', 'KTT_add_custom_header_script_code', 100, 1);


/**
* Este filter se encarga de añadir el codigo extra js del footer al footer combinado
*/
//function KTT_add_custom_header_script_code_to_combined_header($header_content) {
//		return $header_content . ';' . KTT_get_custom_header_script_code();
//}
//add_filter('KTT_combine_js_header_filter', 'KTT_add_custom_header_script_code_to_combined_header', 5, 1);



// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


			// add page to theme options

			$args = array();
			$args['id'] = ktt_var_name('custom-scripts-page');
			$args['page_title'] = __('Custom Scripts',THEME_TEXTDOMAIN);
			$args['page_description'] = __("Custom options related with site's scripts", THEME_TEXTDOMAIN);
			$args['menu_title'] = __('Custom scripts', THEME_TEXTDOMAIN);
			$args['menu_order'] = 15;
			$args['parent'] = 'theme-options';

			$new_admin_submenu = new KTT_admin_submenu($args);





			// add option to admin panel

			$args                           = array();
			$args['option_id']              = ktt_var_name('custom_scripts_extra_footer_scripts');
			$args['option_name']            = __('Extra footer scripts', THEME_TEXTDOMAIN);
			$args['option_label']           = __('', THEME_TEXTDOMAIN);
			$args['option_placeholder']			= __('Insert javascript file url', THEME_TEXTDOMAIN);
			$args['option_description']     = __("You can add extra script files to the queue. This extra files will be added in the footer.", THEME_TEXTDOMAIN);
			$args['option_type']            = 'multiple_text';
			$args['option_default'] 				= '';
			$args['option_order'] 					= 4;
			$args['option_page']            = ktt_var_name('custom-scripts-page');

			$KTT_new_setting = new KTT_new_setting($args);





			// add option to admin panel

			$args                           = array();
			$args['option_id']              = ktt_var_name('custom_scripts_extra_footer_code');
			$args['option_name']            = __('Extra footer JS code', THEME_TEXTDOMAIN);
			$args['option_label']           = __('', THEME_TEXTDOMAIN);
			$args['option_description']     = __("This extra JS code will appear in the footer of the page.", THEME_TEXTDOMAIN);
			$args['option_type']            = 'wp_editor';
			$args['option_type_vars'] 			= array(
																					'wpautop' => false,
																					'media_buttons' => false,
																					'textarea_name' => ktt_var_name('custom_scripts_extra_footer_code'),
																					'textarea_rows' => 15,
																					'teeny' 	=> false,
																					'quicktags' => false,
																					'tinymce' => false,
																			);
			$args['option_default'] 				= '';
			$args['option_order'] 					= 5;
			$args['option_page']            = ktt_var_name('custom-scripts-page');

			$KTT_new_setting = new KTT_new_setting($args);






}
