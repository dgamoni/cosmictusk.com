<?php
/**
 * This is the category template
 * Desde aqui cargaremos la template real que utilizaremos para la categoria que se indique
 */

/**
* Obtenemos la template que la categoria tiene vinculada
*/
$template = KTT_get_current_theme_template();

/**
* Incluimos la template a traves de su path
*/
require($template->path);
