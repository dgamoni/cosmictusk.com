<?php


// add option to admin panel

$templates = KTT_get_theme_templates_by_type('frontpage');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = ktt_var_name('frontpage_posts_template');
$args['option_name']            = __('Posts frontpage', THEME_TEXTDOMAIN);
$args['option_label']           = __('Select a template to display posts.', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select a template to display your latest posts', THEME_TEXTDOMAIN);
$args['option_type']            = 'select';
$args['option_priority']        = 12;
$args['option_type_vars']       = $templates;
$args['option_default'] 		    = 'template-literatum-grid.php'; //array_keys($templates)[0];
$args['option_page']            = 'reading';
$args['option_section']         = 'static_front_page';

$KTT_new_setting = new KTT_new_setting($args);
new KTT_new_customize_setting($args);






 ?>
