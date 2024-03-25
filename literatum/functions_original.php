<?php
/**
 * Narratium functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Narratium
*/


/**
* Incluimos los archivos de configuración propios del theme
*/
require_once('theme-config/theme-config.php');

/**
* load the kohette framework (handy functions!)
*/
require_once('kohette-framework/kohette-framework.php');

/**
* Antes de crear la instancia del framework con el array de configuración aplicamos un filter
* para añadir a la configuración informacion que se haya podido añadir por otras funciones
* esto es util para que cada theme añada su propia configuración del framework.
*/
$theme_config = apply_filters( 'KTT_theme_config', array() );

/**
* create a kohette framework object
*/
$theme = new kohette_framework($theme_config);


/**
* Antes de cargar definitivamente el array de plugins aplicamos un filter para comprobar
* si otras funciones del theme quieren añadir archivos para incluir
* Esto es util para que cada theme añada sus archivos (post_types, scripts, etc)
*/
$plugins = apply_filters( 'KTT_theme_plugins', array());
$theme->load_plugins($plugins);

/**
* Ejecutamos la función que se encarga de activar el theme y cargar las opciones por defecto
* cuando se activa por primera vez desde la pagina themes de la administración
*/
$theme->theme_activation_hook(); // load the default options when theme is activated
