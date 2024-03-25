<?php

/**
* Obtenemos la template que la categoria tiene vinculada
*/
$template = KTT_get_frontpage_posts_template();

/**
* Si no hay template mostramos un mesaje de error
*/
if (!$template) {
	_e("Please, select a template in Settings -> Reading", THEME_TEXTDOMAIN);
	return;
}


/**
* Incluimos la template a traves de su path
*/
require($template->path);
