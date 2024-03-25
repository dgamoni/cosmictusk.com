<?php

/**
* Obtenemos la template que le corresponda al objeto actual
*/
$template = KTT_get_post_template($post);

/**
* Si existe una template la ponemos
*/
if ($template) require($template->path);
