<?php

/**
* Registra las hojas de estilo que se utilizan en el sitio.
*/
function KTT_register_theme_stylesheets() {

      /**
      * En primer lugar definimos la ruta donde tenemos nuestras hojas de estilo
      */
      $css_dir = get_stylesheet_directory() . '/assets/stylesheets/';

      /**
      * Definimos la url desde la que podemos acceder al file con un browser
      */
      $css_url = get_template_directory_uri() . '/assets/stylesheets/';

      /**
      * Vamos a itinerar por cada css que encontremos en el directorio y lo Registramos
      * en nuestro theme
      */
  		foreach (glob( trailingslashit($css_dir) . "*.css") as $css_file) {

            /**
            * Registramos el css que hemos encontrado
            */
            wp_register_style(THEME_TEXTDOMAIN . '-' . basename($css_file, '.css'), trailingslashit($css_url) . basename($css_file));

  		};

}
add_action('wp_enqueue_scripts', 'KTT_register_theme_stylesheets', 2);
