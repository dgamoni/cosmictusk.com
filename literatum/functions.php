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

add_action('wp_footer', 'add_custom_css');
function add_custom_css() {
	global $current_user;
	?>
	<script>
		jQuery(document).ready(function($) {

		});
	</script>
	<style>
        #disqus-count-wrap:hover {
            cursor:pointer;
        }
        .post-item .card-content {
  background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4gPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PGxpbmVhckdyYWRpZW50IGlkPSJncmFkIiBncmFkaWVudFVuaXRzPSJvYmplY3RCb3VuZGluZ0JveCIgeDE9IjAuNSIgeTE9IjAuMCIgeDI9IjAuNSIgeTI9IjEuMCI+PHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwLjIiLz48c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMC44NyIvPjwvbGluZWFyR3JhZGllbnQ+PC9kZWZzPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiIC8+PC9zdmc+IA=='), url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4gPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PGxpbmVhckdyYWRpZW50IGlkPSJncmFkIiBncmFkaWVudFVuaXRzPSJvYmplY3RCb3VuZGluZ0JveCIgeDE9IjAuNSIgeTE9IjAuMCIgeDI9IjAuNSIgeTI9IjEuMCI+PHN0b3Agb2Zmc2V0PSI1MCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMC4xIi8+PHN0b3Agb2Zmc2V0PSI5MCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMC41Ii8+PC9saW5lYXJHcmFkaWVudD48L2RlZnM+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNncmFkKSIgLz48L3N2Zz4g');
  background-size: 100%;
  /* background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, rgba(0, 0, 0, 0.2)), color-stop(100%, rgba(0, 0, 0, 0.87))), -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(50%, rgba(0, 0, 0, 0.1)), color-stop(90%, rgba(0, 0, 0, 0.5)));
  background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.87) 100%), -moz-linear-gradient(top, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.5) 90%);
  background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.87) 100%), -webkit-linear-gradient(top, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.5) 90%);
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.87) 100%), linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.5) 90%); */
background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, rgba(0, 0, 0, 0.2)), color-stop(100%, rgba(0, 0, 0, 0.5))), -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(50%, rgba(0, 0, 0, 0.1)), color-stop(90%, rgba(0, 0, 0, 0.5)));
  background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.5) 100%), -moz-linear-gradient(top, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.5) 90%);
  background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.5) 100%), -webkit-linear-gradient(top, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.5) 90%);
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.5) 100%), linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.5) 90%);
}
	</style>
	<?php
}
