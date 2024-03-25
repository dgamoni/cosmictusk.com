<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Narratium
 */

 /**
 * Obtenemos la template que la categoria tiene vinculada
 */
 $template = KTT_get_current_theme_template();

 /**
 * Incluimos la template a traves de su path
 */
 require($template->path);
