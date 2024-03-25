<?php


/**
* Este hook se encarga de modificar la configuracion del framework
* para añadir un prefix propio para el theme. El prefix sirve para diferenciar
* las variables propias del theme, se añade al principio del nombre de cada variable
* que utiliza el theme mediante la función ktt_var_name
*/
function KTT_custom_prefix( $theme_config ) {

	/**
	* Sustituimos el textdomain existente por el nuevo
	*/
	$theme_config['constants']['prefix'] = 'literatum_';

  /**
  * Devolvemos el array de configuración
  */
  return $theme_config;

}
add_filter( 'KTT_theme_config', 'KTT_custom_prefix' );


?>
