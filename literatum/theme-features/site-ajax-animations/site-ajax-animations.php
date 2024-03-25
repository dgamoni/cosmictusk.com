<?php
/**
* animaciones para transiciones ajax
* version 1.0
*/
require_once('ajax-animations-functions.php');
require_once('ajax-animations-admin.php');

/**
* Obtenemos el effecto activado
*/
$current_effect = KTT_get_current_ajax_animation_effect();

/**
* Si no tenemos un effecto salimos de Aqui
*/
if (!$current_effect) return;

/**
* Si el effecto tiene dependencias vamos a invocarlas
*/
if (isset($current_effect->dependencies) && $current_effect->dependencies) {
  if (isset($current_effect->dependencies['js']) && $current_effect->dependencies['js']) require_once('ajax-animations-load-js-dependencies.php');
  if (isset($current_effect->dependencies['css']) && $current_effect->dependencies['css']) require_once('ajax-animations-load-css-dependencies.php');
}

/**
* Invocamos el effecto
*/
require_once($current_effect->path);
