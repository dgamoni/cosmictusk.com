<?php

/**
* Registra las librerias js que encuentra en el directorio js del theme
*/
function KTT_register_theme_scripts() {

      /**
      * En primer lugar definimos la ruta donde tenemos nuestras hojas de estilo
      */
      $js_dir = get_stylesheet_directory() . '/assets/js/';

      /**
      * Definimos la url desde la que podemos acceder al file con un browser
      */
      $js_url = get_template_directory_uri() . '/assets/js/';

      /**
      * Vamos a itinerar por cada js que encontremos en el directorio y lo Registramos
      * en nuestro theme
      */
  		foreach (glob( trailingslashit($js_dir) . "*.js") as $js_file) {

            /**
            * Registramos el css que hemos encontrado
            */
            wp_register_script(THEME_TEXTDOMAIN . '-' . basename($js_file, '.js'), trailingslashit($js_url) . basename($js_file), array(), false, true);

  		};

}
add_action('init', 'KTT_register_theme_scripts', 2);
