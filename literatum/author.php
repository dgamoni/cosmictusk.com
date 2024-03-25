<?php

/**
* Obtenemos el author
*/
if ( $author_id = get_query_var( 'author' ) ) { $author = KTT_get_user_by( 'id', $author_id ); }

/**
* Obtenemos la template que le corresponda al objeto actual
*/
$template = KTT_get_user_template($author);

/**
* Si existe una template la ponemos
*/
if ($template) require($template->path);
