<?php


// add option to admin panel



$effects = KTT_get_ajax_animations_effects();
$effects = wp_list_pluck($effects, 'name', 'id');
$effects[''] = __('No animation', THEME_TEXTDOMAIN);

// add option to admin panel

$args                           = array();
$args['option_id']              = ktt_var_name('ajax_transition_animation');
$args['option_name']           	= __('Transition Effect', THEME_TEXTDOMAIN);
$args['option_description']     = __('Select an animation effect to use in AJAX transitions', THEME_TEXTDOMAIN);
$args['option_priority'] 				= 42;
$args['option_type']            = 'select';
$args['option_type_vars']       = $effects;
$args['option_default'] 		    = @array_keys($effects)[0];
$args['option_section']    			= ktt_var_name('ajax-navigation');
new KTT_new_customize_setting($args);


 ?>
