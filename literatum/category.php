<?php
/**
 * This is the category template
 * Desde aqui cargaremos la template real que utilizaremos para la categoria que se indique
 */


/**
* Obtenemos la template que la categoria tiene vinculada
*/
$category_template = KTT_get_category_template();

/**
* Incluimos la template a traves de su path
*/
require($category_template->path);
