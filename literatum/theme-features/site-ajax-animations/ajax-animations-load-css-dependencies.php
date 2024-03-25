<?php
/**
* Este script se encarga de cargar las dependencias CSS necesarias que necesitemos para
* las animaciones ajax del sitio según esté configurado
*/





/**
 * Cargamos solo los elementos basicos css.
 */
function KTT_load_ajax_animations_stylesheets() {

    /**
    * Reset del sitio
    */
    wp_enqueue_style( THEME_TEXTDOMAIN . '-ajax-transitions-base');


}
add_action( 'wp_enqueue_scripts', 'KTT_load_ajax_animations_stylesheets', 4 );




/**
* Registra las hojas de estilo que se utilizan en el sitio.
*/
function KTT_register_ajax_animations_stylesheets() {

      /**
      * En primer lugar definimos la ruta donde tenemos nuestras hojas de estilo
      */
      $css_dir = trailingslashit(KTT_get_ajax_animations_src_path() . 'css');;

      /**
      * Definimos la url desde la que podemos acceder al file con un browser
      */
      $css_url =  KTT_path_to_url($css_dir);

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
add_action('wp_enqueue_scripts', 'KTT_register_ajax_animations_stylesheets', 3);


 ?>
