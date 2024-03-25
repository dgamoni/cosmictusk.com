<?php
/**
* https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
*/


/**
* Esta funcion se encarga de formar y devolver el array con la configuracion inicial
* del theme
*/
function KTT_get_starter_content_data() {

    /**
    * Definimos el array base
    */
    $result = array(
        /**
        * Definimos las opciones generales recomendadas del theme
        */
        'options' => array(
              'show_on_front' => 'posts',
              'posts_per_page' => 12,
        ),
        'theme_mods' => array(),
        'posts' => array(),
        'nav_menus' => array(),
        'widgets' => array(),
    );

    /**
    * Al array le aplicamos un filter, de esta manera puede ser modificado
    * desde terceras funciones
    */
    $result = apply_filters('KTT_starter_content_data', $result);

    /**
    * Devolvemos el array
    */
    return $result;

}


/**
* Indicamos que este theme tiene soporter para starter content
*/
add_action('after_setup_theme', function () {
    add_theme_support('starter-content', KTT_get_starter_content_data());
});





 ?>
