<?php


/**
* Obtenemos las templates disponibles para las categorias
*/
$templates = KTT_get_theme_templates_by_type('post_tag');
$templates = wp_list_pluck($templates, 'name', 'id');
$templates[] = 'Default';


// add featured image option to post_tag admin pages
$args                          	 = array();
$args['taxmeta_taxonomy']        = 'post_tag';
$args['taxmeta_id']              = ktt_var_name('post_tag_template');
$args['taxmeta_name']            = __('Template', THEME_TEXTDOMAIN);
$args['taxmeta_description']     = __('Select a template for this tag.', THEME_TEXTDOMAIN);
$args['taxmeta_default']         = get_option(ktt_var_name('post_tag_template'));
$args['taxmeta_type']            = 'select';
$args['taxmeta_type_vars'] 		   = $templates;

$KTT_new_taxonomy_meta = new KTT_new_taxonomy_meta($args);
