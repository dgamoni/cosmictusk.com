<?php
/**
* Este script se encarga de cargar las dependencias JS necesarias que necesitemos para
* las animaciones ajax del sitio según esté configurado
*/





/**
* Cargamos las librerias JS
*/
function KTT_load_ajax_animations_scripts() {

      wp_enqueue_script( THEME_TEXTDOMAIN . '-snap.svg-min');
      wp_enqueue_script( THEME_TEXTDOMAIN . '-svgLoader');
      wp_add_inline_script( THEME_TEXTDOMAIN . '-svgLoader', 'var loader = new SVGLoader( document.getElementById( "loader" ), { speedIn : 500, easingIn : mina.easeinout } );' );

}
add_action( 'wp_enqueue_scripts', 'KTT_load_ajax_animations_scripts', 5 );





/**
* Registramos las librerias js
*/
function KTT_register_ajax_animations_scripts() {

      /**
      * En primer lugar definimos la ruta donde tenemos nuestras hojas de estilo
      */
      $js_dir = trailingslashit(KTT_get_ajax_animations_src_path() . 'js');

      /**
      * Definimos la url desde la que podemos acceder al file con un browser
      */
      $js_url = KTT_path_to_url($js_dir);

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
add_action('wp_enqueue_scripts', 'KTT_register_ajax_animations_scripts', 3);





 ?>
