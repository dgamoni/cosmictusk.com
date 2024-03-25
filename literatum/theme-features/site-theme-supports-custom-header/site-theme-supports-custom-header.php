<?php
/**
* Añadimos soporte de custom header al themes
*/

/**
* Definimos un array con la configuracion del header
*/
$header_info = array(
    'width'         => 1200,
    'flex-width'    => true,
    'height'        => 1200,
    'flex-height'    => true,
    //'default-image' => get_template_directory_uri() . '/images/sunset.jpg',
    'random-default'        => false,
    'uploads'       => true,
    'video' => true,
    //'video-active-callback' => 'is_front_page',
    //'wp-head-callback'      => 'wphead_cb',
    //'admin-head-callback'       => 'adminhead_cb',
    //'admin-preview-callback'    => 'adminpreview_cb',

);
add_theme_support( 'custom-header', $header_info );

 ?>
