<?php


// add option to admin panel

$templates = KTT_get_theme_color_templates();
$templates = wp_list_pluck($templates, 'name', 'id');

$args                           = array();
$args['option_id']              = ktt_var_name('site_color_template');
$args['option_name']            = __('Site color template', THEME_TEXTDOMAIN);
$args['option_label']           = __('Select a color template for this site.', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select a color template for this site.', THEME_TEXTDOMAIN);
$args['option_type']            = 'select';
$args['option_priority']        = 15;
$args['option_type_vars']       = $templates;
$args['option_default'] 		    = reset($templates);
$args['option_page']            = 'reading';
$args['option_section']         = 'colors';

$KTT_new_setting = new KTT_new_setting($args);
new KTT_new_customize_setting($args);








/**
* Este filter se encarga de añadir el css al site
*/
function KTT_add_color_template_css_to_site($current_css) {

    /**
    * Obtenemos la opcion qye contiene el color base del sitiio
    */
    $color_template_id = get_option(ktt_var_name('site_color_template'), 'default');

    /**
    * Obtenemos la tempalte
    */
    $template_css = KTT_get_theme_color_template_css($color_template_id);

    /**
    * Si hay template...
    */
    if ($template_css) {

        /**
        * Obtenemos el css de la template
        */
        $current_css .= ';' . $template_css;

    }

    /**
    * Devolvemos el css modificado
    */
    return $current_css;
}
add_action('KTT_add_site_custom_css', 'KTT_add_color_template_css_to_site', 5, 1);


 ?>
