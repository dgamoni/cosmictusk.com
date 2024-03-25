<?php
/**
 * Add a little firm/copyright text for the site in settings -> general
 *
 */




// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------



				$args                           = array();
				$args['option_id']              = ktt_var_name('website_firm');
				$args['option_name']            = __('Website Firm', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('This text will appear in the bottom side of the sidebar.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'wp_editor';
				$args['option_priority']				= 20;
				$args['option_default'] 				= '';
				$args['option_type_vars'] 			= array(
																		    	'wpautop' => false,
																		    	'media_buttons' => false,
																		    	'textarea_name' => ktt_var_name('website_firm'),
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
