<?php
/**
 * Add a new field in the post editor to add photo credit for featured images.
 *
 */



/**
* Registramos la libreria en la cola de librerias
*/
function KTT_register_sharecontent_js() {

		/**
		* Registramos la libreria
		*/
		wp_register_script(THEME_TEXTDOMAIN . '-sharecontent',
												KTT_path_to_url(dirname(__FILE__)) . '/js/combined.js',
												array ('jquery'),
												false, false);

}
//add_action( 'wp_enqueue_scripts', 'KTT_register_sharecontent_js', 1 );




/**
* Registramos la hoja de estilos
*/
function KTT_register_sharecontent_css() {

		/**
		* Registramos la libreria
		*/
		wp_register_style(THEME_TEXTDOMAIN . '-sharecontent',
												KTT_path_to_url(dirname(__FILE__)) . '/css/tooltipster.min.css'
												);

}
//add_action( 'wp_enqueue_scripts', 'KTT_register_sharecontent_css', 1 );










/**
* Esta funcion captura un filtro y se encarga de añadir la libreria css
* de esta feature a la queue de estilos de la template
*/
function KTT_add_css_style_to_template_queue( $styles, $template) {

		/**
		* Debemos mirar en las opciones de la template si se encuentra habilitada
		* la opcion "enable_sharecontent", si es asi le añadimos la librerias
		*/
		if (isset($template->options['enable_sharecontent']) && $template->options['enable_sharecontent']) {
			$styles[] = 'sharecontent';
		}

		/**
		* Pase lo que pase al final debemos devolver un array con la lista de
		* handles de estilos css
		*/
		return $styles;

}
//add_filter('KTT_theme_template_stylesheets', 'KTT_add_css_style_to_template_queue', 2, 2);







/**
* Este filtro permite añadir la opcion a la pagina de administracion de template
*/
function KTT_add_sharecontent_option_to_template($options, $template) {

		/**
		* Si la template es para un post entonces añadimos la opcion
		*/
		if (in_array('post', $template->types)) {

				$options['enable_sharecontent']['option_name']            = __('Enable share content tooltip', THEME_TEXTDOMAIN);
				$options['enable_sharecontent']['option_label']           = __("Display a tooltip with share links when the user selects an extract of the article's content.", THEME_TEXTDOMAIN);
				$options['enable_sharecontent']['option_description']     = __("Check this option to active the share tooltip",THEME_TEXTDOMAIN);
				$options['enable_sharecontent']['option_type']            = 'checkbox';
				$options['enable_sharecontent']['option_priority'] 			 	= 2;
				$options['enable_sharecontent']['option_default']         = 0;

		}

		/**
		* Pase lo que pase al final debemos devolver un array con la lista de
		* options
		*/
		return $options;

}
//add_filter('KTT_theme_template_options', 'KTT_add_sharecontent_option_to_template', 2, 2);















/**
* reload sharecontent after ajax call
*/
function KTT_sharecontent_reload() {

    // this is javascript code
    ?>
    jQuery("article p, article blockquote").contentshare({
            shareLinks : ["http://www.facebook.com/sharer/sharer.php?s=100&u="+document.URL+"&title="+document.title+"&summary=" , "http://twitter.com/intent/tweet?url="+document.URL+"&text="],
    });
    jQuery.fn.contentshare.defaults.shareable.on('mouseup',function(){
        jQuery.fn.contentshare.showTooltip();
    });
    <?php
}
//add_action('KTT_theme_ajax_load_content_after', 'KTT_sharecontent_reload');





?>
