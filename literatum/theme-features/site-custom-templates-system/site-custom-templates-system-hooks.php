<?php
/**
* Hooks template system
*/



/**
* Este hook nos permite cargar las librerias correctas asociadas con la template que se
* este mostrando en todo momento
*/
/**
 * Cargamos los stylesheerts de la frontpage default
 */
function KTT_load_template_stylesheets() {

      /**
      * Obtenemos la template que estamos usando
      */
      global $template;

      /**
      * Si no hay template salimos de aqui
      */
      if (!$template) return;

      /**
      * Este filtro nos permite añadir librerias extra de manera dinamica
      * a traves de terceras funciones
      */
      $template->styles = apply_filters('KTT_theme_template_stylesheets', $template->styles, $template);

      /**
      * Si no tiene styles definidos salimos de aqui
      */
      if (!isset($template->styles) && !$template->styles) return;

      /**
      * Por cada uno de los estiles añadimos su css a la queue
      */
      foreach( $template->styles as $css_file_handle) wp_enqueue_style( THEME_TEXTDOMAIN . '-' . $css_file_handle);


}
add_action( 'wp_enqueue_scripts', 'KTT_load_template_stylesheets', 5 );




/**
* Este hook se encarga de crear la global $template que contendra informacion
* importante sobre la template que se está usando, podemos recurir a esta variable
* para obtener informacion sobre las diferentes opciones que la template permite
*/
function KTT_create_template_global() {

      /**
      * Obtenemos la template que estamos usando
      */
      $current_template = KTT_get_current_theme_template();
      if ($current_template) global $template;
      $template = $current_template;

      /**
      * Añadimos las opciones a la template
      */
      $template->options = KTT_get_template_options($template->id);

}
add_action( 'wp_enqueue_scripts', 'KTT_create_template_global', 4 );
