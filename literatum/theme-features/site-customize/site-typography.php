<?php
/**
 * Customize options for the theme
 *
 */






// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------



				// add page to theme options

				$args = array();
				$args['panel_id'] 						= ktt_var_name('customize-typography');
				$args['panel_title'] 					= __('Fonts & Typography',THEME_TEXTDOMAIN);
				$args['panel_description'] 		= __("Customize the theme's typography related elements.", THEME_TEXTDOMAIN);
				$args['panel_priority'] 			= 1;
				new KTT_new_customize_panel($args);





				/**
				* Una seccion nos ayuda a organizar los elementos de la pagina
				*/

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('site-typefaces');
				$args['section_title']            = __('Typography Typefaces', THEME_TEXTDOMAIN);
				$args['section_description']     	= sprintf(__('Select the custom typefaces to use in %s.', THEME_TEXTDOMAIN), get_bloginfo('name'));
				$args['section_panel']            = ktt_var_name('customize-typography');
				new KTT_new_customize_section($args);







				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('site_typeface_title');
				$args['option_name']           = __('Titles typeface', THEME_TEXTDOMAIN);
				$args['option_description']     = __('This is the typeface used in titles.', THEME_TEXTDOMAIN);
				$args['option_priority'] 				= 1;
				$args['option_type']            = 'font';
				$args['option_type_vars']				= array(
																					'selector' => '.site-typeface-title, site-typeface-title-1, site-typeface-title-2, site-typeface-title-3',
																					'font_family' => true,

																					);
				$args['option_default'] 				= array(
																					'font_family' => 'domine',
																					'font_weight' => 'regular',
																					'load_all_weights' => true,
																					);
				$args['option_section']    			= ktt_var_name('site-typefaces');
				new KTT_new_customize_setting($args);







				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('site_typeface_headline');
				$args['option_name']           = __('Headlines typeface', THEME_TEXTDOMAIN);
				$args['option_description']     = __('This is the typeface used by headlines and subtitles.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_priority'] 				= 2;
				$args['option_type_vars']				= array(
																						'selector' => '.site-typeface-headline',
																						'font_family' => true,
																				);
				$args['option_default'] 				= array(
																						'font_family' => 'roboto',
																						'font_weight' => 'regular',
																						'load_all_weights' => true,
																				);
				$args['option_section']    			= ktt_var_name('site-typefaces');;
				new KTT_new_customize_setting($args);







				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('site_typeface_content');
				$args['option_name']           = __('Content typeface', THEME_TEXTDOMAIN);
				$args['option_description']     = __('This is the typeface used in post/page contents.', THEME_TEXTDOMAIN);
				$args['option_type']           	= 'font';
				$args['option_priority'] 				= 3;
				$args['option_type_vars']		= array(
																					'selector' => '.site-typeface-content',
																					'font_family' => true,
																				);
				$args['option_default'] 				= array(
																					'font_family' => 'pt+serif',
																					'font_weight' => 'regular',
																					'load_all_weights' => true,
																				);

				$args['option_section']    			= ktt_var_name('site-typefaces');;
				new KTT_new_customize_setting($args);









				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('site_typeface_body');
				$args['option_name']           = __('Body typeface', THEME_TEXTDOMAIN);
				$args['option_description']     = __('This is the typeface used by default in the site.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_priority'] 				= 4;
				$args['option_type_vars']		= array(
																					'selector' => '.site-typeface-body',
																					'font_family' => true,
																				);
				$args['option_default'] 				= array(
																					'font_family' => 'roboto',
																					'font_weight' => 'regular',
																					'load_all_weights' => true,
																				);
				$args['option_section']    			= ktt_var_name('site-typefaces');;
				new KTT_new_customize_setting($args);




















				/**
				* Una seccion nos ayuda a organizar los elementos de la pagina
				*/

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('custom-typography-basic-section');
				$args['section_title']            = __('Basic Typography', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the basic typography of the site.', THEME_TEXTDOMAIN);
				$args['section_panel']            = ktt_var_name('customize-typography');
				new KTT_new_customize_section($args);









				// add option to admin panel

				$args                           	= array();
				$args['option_id']              	= ktt_var_name('typo_style_body');
				$args['option_name']            	= __('Default site font', THEME_TEXTDOMAIN);
				$args['option_description']     	= __('This is the font used in the entire site by default.', THEME_TEXTDOMAIN);
				$args['option_type']            	= 'font';
				$args['option_priority'] 					= 1;
				$args['option_type_vars']					= array(
																						'selector' => 'html, body',
																						'font_size' => true,
																						'line_height' => true,
																						'font_family' => false,
																					);
				$args['option_default'] 					= array(
																						'font_size' => '18',
																						'font_size_unit' => 'px',
																						'line_height' => '1.4',
																						//'color' => '#5f5858',
																					);
				$args['option_section']    				= ktt_var_name('custom-typography-basic-section');;
				new KTT_new_customize_setting($args);





				// add option to admin panel ----------------------------------------------------------------

				$args                           	= array();
				$args['option_id']              	= ktt_var_name('typo_style_h1');
				$args['option_name']            	= __('Headline 1', THEME_TEXTDOMAIN);
				$args['option_description']     	= __('Adjust the size and line height used in h1 tags.', THEME_TEXTDOMAIN);
				$args['option_type']            	= 'font';
				$args['option_priority'] 					= 2;
				$args['option_type_vars']					= array(
																						'selector' => 'body h1',
																						'font_size' => true,
																						'font_family' => false,
																						'line_height' => true,
																					);
				$args['option_default'] 					= array(
																						'font_size' => '2.2',
																						'font_size_unit' => 'em',
																						'line_height' => '1.1',
																						'font_family' => '',
																						'font_weight' => 'regular'
																						//'color' => '#5f5858',
																					);
				$args['option_section']    				= ktt_var_name('custom-typography-basic-section');;
				new KTT_new_customize_setting($args);




				// add option to admin panel ----------------------------------------------------------------

				$args                           	= array();
				$args['option_id']              	= ktt_var_name('typo_style_h2');
				$args['option_name']            	= __('Headline 2', THEME_TEXTDOMAIN);
				$args['option_description']     	= __('Adjust the size and line height used in h2 tags.', THEME_TEXTDOMAIN);
				$args['option_type']            	= 'font';
				$args['option_priority'] 					= 3;
				$args['option_type_vars']					= array(
																						'selector' => 'body h2',
																						'font_size' => true,
																						'font_family' => false,
																						'line_height' => true,
																					);
				$args['option_default'] 					= array(
																						'font_size' => '2',
																						'font_size_unit' => 'em',
																						'line_height' => '1.1',
																						'font_family' => '',
																						'font_weight' => 'regular'
																						//'color' => '#5f5858',
																					);
				$args['option_section']    				= ktt_var_name('custom-typography-basic-section');;
				new KTT_new_customize_setting($args);




				// add option to admin panel ----------------------------------------------------------------

				$args                           	= array();
				$args['option_id']              	= ktt_var_name('typo_style_h3');
				$args['option_name']            	= __('Headline 3', THEME_TEXTDOMAIN);
				$args['option_description']     	= __('Adjust the size and line height used in h3 tags.', THEME_TEXTDOMAIN);
				$args['option_type']            	= 'font';
				$args['option_priority'] 					= 4;
				$args['option_type_vars']					= array(
																						'selector' => 'body h3',
																						'font_size' => true,
																						'font_family' => false,
																						'line_height' => true,
																					);
				$args['option_default'] 					= array(
																						'font_size' => '1.8',
																						'font_size_unit' => 'em',
																						'line_height' => '1.1',
																						'font_family' => '',
																						'font_weight' => 'regular'
																					//'color' => '#5f5858',
																					);
				$args['option_section']    				= ktt_var_name('custom-typography-basic-section');;
				new KTT_new_customize_setting($args);











				/**
				* Una seccion nos ayuda a organizar los elementos de la pagina
				*/
				$args                           	= array();
				$args['section_id']              	= ktt_var_name('custom-typography-body-section');
				$args['section_title']            = __('Post/Pages Typography', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the typography of the site used by default in posts and pages.', THEME_TEXTDOMAIN);
				$args['section_panel']            = ktt_var_name('customize-typography');
				new KTT_new_customize_section($args);




				// add option to admin panel

				$args                           	= array();
				$args['option_id']              	= ktt_var_name('typo_style_content');
				$args['option_name']            	= __('Content', THEME_TEXTDOMAIN);
				$args['option_description']     	= __('Adjust the font style of text used in main contents of the site. This font style is used in the body content of posts and pages by default.', THEME_TEXTDOMAIN);
				$args['option_type']            	= 'font';
				$args['option_priority'] 					= 10;
				$args['option_type_vars']					= array(
																						'selector' => '.typo-size-content',
																						'font_size' => true,
																						'line_height' => true,
																						'font_family' => false,
																					);
				$args['option_default'] 					= array(
																						'font_size' => '21',
																						'font_size_unit' => 'px',
																						'line_height' => '1.5',
																					);
				$args['option_section']    				= ktt_var_name('custom-typography-body-section');;
				new KTT_new_customize_setting($args);


































?>
