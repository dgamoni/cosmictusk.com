<?php


/**
* Este hook se encarga de modificar el array de plugins del framework
* para añadir los archivos php necesarios para el funcionamiento del theme
* Es util para añadir funcionalidades que son unicas de este theme
*/
function KTT_custom_theme_plugins( $plugins ) {



		/**
		* Cargamos cada post_type que tengamos
		*/
		foreach (glob(get_stylesheet_directory() . "/post-types/*", GLOB_ONLYDIR) as $post_type) {

		    $plugins[] = array(
					'name' => basename($post_type),
					'source' => $post_type . '/' . basename($post_type) . '.php',
				);

				$plugins[] = array(
					'name' => basename($post_type) . '_functions',
					'source' => $post_type . '/' . basename($post_type) . '-functions' . '/' . basename($post_type) . '-functions.php',
				);

		};

		/**
		* Cargamos las features de los post_types
		*/
		foreach (glob( get_stylesheet_directory() . "/post-types/*/*-features/*", GLOB_ONLYDIR) as $filename) {

			$plugins[] = array(
				'name' => basename($filename),
				'source' => $filename . '/' . basename($filename) . '.php',
			);

		};

		/**
		* Itineramos por cada una de las features unicas del theme y las añadimos al array
		*/
		foreach (glob(get_stylesheet_directory() . "/theme-features/*", GLOB_ONLYDIR) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename . '/' . basename($filename) . '.php',
				);

		};






		// Cargamos las funciones de las taxonomias ---------------------------------------------

		foreach (glob(get_stylesheet_directory() . "/taxonomies/*/*_functions.php", GLOB_NOSORT) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename,
			);

		};

		// ---------------------------------------------------------------------------------------


		// Cargamos las features de las taxonomias ---------------------------------------------

		foreach (glob(get_stylesheet_directory() . "/taxonomies/*/*_features/*", GLOB_ONLYDIR) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename . '/' . basename($filename) . '.php',
			);

		};

		// ---------------------------------------------------------------------------------------

		// Cargamos los taxonomias ----------------------------------------------------------------

		foreach (glob(get_stylesheet_directory() . "/taxonomies/*", GLOB_ONLYDIR) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename . '/' . basename($filename) . '.php',
			);

		};

		// ---------------------------------------------------------------------------------------


		// Cargamos los tablas de las taxonomias ----------------------------------

		foreach (glob(get_stylesheet_directory() . "/taxonomies/*/*_table.php", GLOB_NOSORT) as $filename) {

		    $plugins[] = array(
				'name' => basename($filename),
				'source' => $filename,
			);

		};

		// ---------------------------------------------------------------------------------------



	  /**
	  * Devolvemos el array de configuración
	  */
	  return $plugins;

}
add_filter( 'KTT_theme_plugins', 'KTT_custom_theme_plugins' );
