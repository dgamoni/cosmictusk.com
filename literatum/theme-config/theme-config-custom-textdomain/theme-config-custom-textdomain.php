<?php


/**
* Este hook se encarga de modificar la configuracion del framework
* para añadir un textdomain propio para el theme
*/
function KTT_custom_textdomain( $theme_config ) {

		/**
		* Sustituimos el textdomain existente por el nuevo
		*/
		$theme_config['constants']['textdomain'] = 'literatum';

	  /**
	  * Devolvemos el array de configuración
	  */
	  return $theme_config;

}
add_filter( 'KTT_theme_config', 'KTT_custom_textdomain' );


?>
