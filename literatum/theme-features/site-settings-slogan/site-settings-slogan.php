<?php
/**
 * Add an slogan input for the site in settings -> general
 *
 */






				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('website_slogan');
				$args['option_name']            = __('Website Slogan', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('This text will be displayed next to the website logo/name.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'wp_editor';
				$args['option_priority']				= 15;
				$args['option_default'] 				= __('This is the website slogan, it can be edited in Appearance / Customize / Site Identity. You can display here a brief description of your site with <a target="_blank" href="http://twitter.com/mrrafaelmartin">links</a> and <u>some</u> text <strong>format</strong>.',THEME_TEXTDOMAIN);
				$args['option_type_vars'] 			= array(
																		    	'wpautop' => false,
																		    	'media_buttons' => false,
																		    	'textarea_name' => ktt_var_name('website_slogan'),
																		    	'textarea_rows' => 2,
																		    	//'teeny' 	=> true,
																		    	'quicktags' => false,
																		    	'tinymce' => array(
																		        				'toolbar1'=> 'bold,italic,underline,link,unlink,forecolor'
																		      	)
												      					);
				$args['option_section']         = 'title_tagline';

				 new KTT_new_customize_setting($args);



?>
