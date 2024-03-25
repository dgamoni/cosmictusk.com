<?php

/**
* Definimos las funcionalidades de WP que soportamos en el themes
*/

/**
* Soporte para Thumbnails
*/
add_theme_support( 'post-thumbnails' );

/**
* Soporte para html5
*/
add_theme_support( 'html5', array(
  'comment-list',
  'search-form',
  'comment-form',
  'gallery',
  'caption',
) );



/**
* Support for title-tag
* #https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
*/
function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );


/**
* Backwards compatibility for title tag
*/
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function theme_slug_render_title() {
      ?>
      <title><?php wp_title( '|', true, 'right' ); ?></title>
      <?php
    }
    add_action( 'wp_head', 'theme_slug_render_title' );
endif;


/**
* Soporte para theme logueado
*/
function KTT_theme_logo_support() {

	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 'auto',
		'flex-width' => true,
    'flex-height' => true,
	) );

}
add_action( 'after_setup_theme', 'KTT_theme_logo_support' );


 ?>
