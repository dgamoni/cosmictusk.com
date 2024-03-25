<?php
/**
* A template system for the themes
*/

/**
* Cargamos las funciones relacionadas con el sistema de templates
*/
require_once('site-custom-templates-system-functions.php');

/**
* Cargamos los hooks relacionados con el sistema de templates
*/
require_once('site-custom-templates-system-hooks.php');



/**
* Definimos el panel de administracion dentro del cual van a ir todas las secciones
* y opciones relacionadas con el sistema de templates del theme
*/
$args = array();
$args['panel_id'] 						= ktt_var_name('custom-templates-system');
$args['panel_title'] 					= __('Templates',THEME_TEXTDOMAIN);
$args['panel_description'] 		= __("Customize and configure the theme's templates.", THEME_TEXTDOMAIN);
$args['panel_priority'] 			= 10;
new KTT_new_customize_panel($args);



$args                           	= array();
$args['section_id']              	= ktt_var_name('custom-templates-system');
$args['section_title']            = __('Default Templates', THEME_TEXTDOMAIN);
$args['section_description']     	= sprintf(__('Select the default templates to use in the site', THEME_TEXTDOMAIN), get_bloginfo('name'));
$args['section_panel']            = ktt_var_name('custom-templates-system');
new KTT_new_customize_section($args);




/**
* Definimos las opcioens generales referentes a las plantillas del theme
*/
$templates = KTT_get_theme_templates_by_type('post');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = ktt_var_name('post_template');
$args['option_name']           	= __('Post Template', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select the default template to use in posts pages.', THEME_TEXTDOMAIN);
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= array_keys($templates)[0];
$args['option_section']    			= ktt_var_name('custom-templates-system');
new KTT_new_customize_setting($args);



/**
* Definimos las opcioens generales referentes a las plantillas del theme
*/
$templates = KTT_get_theme_templates_by_type('page');
$templates = wp_list_pluck($templates, 'name', 'id');



$args                           = array();
$args['option_id']              = ktt_var_name('page_template');
$args['option_name']           	= __('Page Template', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select the default template to use in pages.', THEME_TEXTDOMAIN);
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= array_keys($templates)[0];
$args['option_section']    			= ktt_var_name('custom-templates-system');
new KTT_new_customize_setting($args);




/**
* Definimos las opcioens generales referentes a las plantillas del theme
*/
$templates = KTT_get_theme_templates_by_type('category');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = ktt_var_name('category_template');
$args['option_name']           	= __('Category Template', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select the default template to use in category pages.', THEME_TEXTDOMAIN);
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-literatum-columns.php';
$args['option_section']    			= ktt_var_name('custom-templates-system');
new KTT_new_customize_setting($args);



/**
* Definimos las opcioens generales referentes a las plantillas del theme
*/
$templates = KTT_get_theme_templates_by_type('post_tag');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = ktt_var_name('post_tag_template');
$args['option_name']           	= __('Tag Template', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select the default template to use in tag pages.', THEME_TEXTDOMAIN);
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-literatum-list.php';
$args['option_section']    			= ktt_var_name('custom-templates-system');
new KTT_new_customize_setting($args);



/**
* Definimos las opcioens generales referentes a las plantillas del theme
*/
$templates = KTT_get_theme_templates_by_type('archive');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = ktt_var_name('archive_template');
$args['option_name']           	= __('Archive Template', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select the default template to use in archive pages.', THEME_TEXTDOMAIN);
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-literatum-list.php';
$args['option_section']    			= ktt_var_name('custom-templates-system');
new KTT_new_customize_setting($args);



/**
* Definimos las opcioens generales referentes a las plantillas del theme
*/
$templates = KTT_get_theme_templates_by_type('search');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = ktt_var_name('search_template');
$args['option_name']           	= __('Search Template', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select the default template to use in search pages.', THEME_TEXTDOMAIN);
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-literatum-list.php';
$args['option_section']    			= ktt_var_name('custom-templates-system');
new KTT_new_customize_setting($args);


/**
* Definimos las opcioens generales referentes a las plantillas del theme
*/
$templates = KTT_get_theme_templates_by_type('user');
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = ktt_var_name('user_template');
$args['option_name']           	= __('Author Template', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select the default template to use in author profile pages.', THEME_TEXTDOMAIN);
$args['option_priority'] 				= 1;
$args['option_type']            = 'select';
$args['option_type_vars']       = $templates;
$args['option_default'] 				= 'template-literatum-profile.php';
$args['option_section']    			= ktt_var_name('custom-templates-system');
new KTT_new_customize_setting($args);



















/**
* Obtenemos la lista de templates del theme
*/
$templates = KTT_get_theme_templates();

/**
* Itineramos por cada uno de las templates y las incluimos en la request para cargar
* sus opciones
*/
$config_mode = true;
if( current_user_can('administrator')) if ($templates) foreach($templates as $template) {

    /**
    * Creamos la sección
    */
    $args                           	= array();
    $args['section_id']              	= ktt_var_name('template_options_page_' . $template->id);
    $args['section_title']            = __('Template', THEME_TEXTDOMAIN) . ': ' . $template->name;
    $args['section_description']     	= @$template->description;
    $args['section_panel']            = ktt_var_name('custom-templates-system');
    new KTT_new_customize_section($args);

    /**
    * Despues de crear la seccion intentamos obtener el array de opciones
    * que la propia template debe proporcionar
    */
    $template_options = include($template->path);

    /**
    * Este filter tan majo nos permite añadir opciones dinamicamente a la template
    * desde terceras funciones
    */
    $template_options = apply_filters('KTT_theme_template_options',  $template_options, $template);

    /**
    * Si hemos obtenido un array de opciones vamos a itinerar por cada
    * una de ellas y las añadimos a la lista
    */
    if ($template_options) foreach ($template_options as $option_id => $args) {

          /**
          * Si no tiene option_id le creamos una
          */
          if (!isset($args['option_id'])) $args['option_id'] = ktt_var_name('template_' . $template->id . '_option_' . $option_id);

          /**
          * Si no se ha indicado una seccion le creamos el handle
          */
          if (!isset($args['option_section'])) $args['option_section'] = ktt_var_name('template_options_page_' . $template->id);

          /**
          * Añadimos la opcion al admin!
          */
          new KTT_new_customize_setting($args);

    }


}
$config_mode = false;
