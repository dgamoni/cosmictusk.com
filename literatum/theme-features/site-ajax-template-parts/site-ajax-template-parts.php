<?php
/**
* En caso de este theme tener funcionalidad ajax vamos a indicarle que partes
* de una template son actualizables
*/


/**
* Si ajax no esta presente o no esta activo salimos de Aqui
*/
if (!function_exists('KTT_ajax_is_enabled') || !KTT_ajax_is_enabled() ) return;


/**
* En esta funcion vamos a formar el array con la informacion sobre las distintas
* partes dinamicas del sitio que pueden ser cargadas mediante llamadas ajax
*/
function KTT_theme_ajax_template_parts_filter($result) {

    /**
    * Indicamos el wrap del body
    */
    $result[] = array(
      'selector' => '#site-wrap',
      'content' => '',
    );



    /**
    * Actualizamos el header completo
    */
    /*
    $result[] = array(
      'selector' => 'head',
      'content' => '',
    );
    */


    /**
    * Devovlemos el array modificado
    */
    return $result;

}
add_filter('KTT_theme_ajax_template_parts', 'KTT_theme_ajax_template_parts_filter', 5, 1);


 ?>
