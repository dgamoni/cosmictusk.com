<?php
/**
* Este script se encarga de eliminar el input e titulo de las entradas
*/



function KTT_remove_post_title_input() {remove_post_type_support('post', 'title');};
add_action('admin_init', 'KTT_remove_post_title_input');

 ?>
