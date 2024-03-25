<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

 /**
 * Obtenemos la template que la categoria tiene vinculada
 */
 $template = KTT_get_current_theme_template();

 /**
 * Incluimos la template a traves de su path
 */
 require($template->path);
