<?php
/**
 * The header for our theme
 * *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Narratium
 */

?><!DOCTYPE html>
<html <?php html_class(); ?> layout="row" <?php language_attributes(); ?>>
    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>

    </head>
    <body style="overflow:hidden" <?php KTT_body_attrs();?> ng-cloak layout="column" flex <?php body_class(); ?>>
      <?php do_action('KTT_theme_body_start');?>
      <div  id="site-wrap"  flex layout="row" class="site-wrap">
