<?php
/**
 * Cargamos solo los elementos basicos js
 */
function KTT_load_common_scripts() {

    /**
    * Cargamos la librería ktt-backgorund
    */
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( THEME_TEXTDOMAIN . '-ktt-backgroundy');

}
add_action( 'wp_enqueue_scripts', 'KTT_load_common_scripts', 3 );



/**
* Esta funcion se encarga de cargar las librerias referentes a angularjs
*/
function KTT_load_angularjs_scripts() {

  wp_enqueue_script( THEME_TEXTDOMAIN . '-angular.min');
  wp_enqueue_script( THEME_TEXTDOMAIN . '-angular-animate.min');
  wp_enqueue_script( THEME_TEXTDOMAIN . '-angular-aria.min');
  wp_enqueue_script( THEME_TEXTDOMAIN . '-angular-material.min');
  wp_enqueue_script( THEME_TEXTDOMAIN . '-main-app');

}
add_action( 'wp_enqueue_scripts', 'KTT_load_angularjs_scripts', 4 );
