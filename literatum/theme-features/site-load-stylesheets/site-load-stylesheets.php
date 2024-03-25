<?php
/**
 * Cargamos solo los elementos basicos css.
 */
function KTT_load_common_stylesheets() {

    /**
    * Reset del sitio
    */
    wp_enqueue_style( THEME_TEXTDOMAIN . '-angular-material.min');

    /**
    * Estilo base con los elementos generales del sitio
    */
    wp_enqueue_style( THEME_TEXTDOMAIN . '-base');

    /**
    * Estilo base con los elementos generales del sitio
    */
    wp_enqueue_style( THEME_TEXTDOMAIN . '-icons');


}
add_action( 'wp_enqueue_scripts', 'KTT_load_common_stylesheets', 3 );
