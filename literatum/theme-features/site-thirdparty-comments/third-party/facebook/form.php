<?php
/**
 * admin panel options for disqus
 *
 */




// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {



				// add section for logo and favicon

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('facebook-section');
				$args['section_name']            	= __('Facebook configuration', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure Facebook comments for your site.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('thirdpary-comments-page');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('facebook_comments_app_id');
				$args['option_name']            = __('Facebook App ID', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = sprintf(__("Initialize the Facebook JavaScript SDK using this app.", THEME_TEXTDOMAIN), get_bloginfo('name'));;
				$args['option_type']            = 'text';
				$args['option_default'] 		= get_option(ktt_var_name('site_facebook_app_id'));
				$args['option_order']			= 4;
				$args['option_page']            = ktt_var_name('thirdpary-comments-page');
				$args['option_page_section'] 	= ktt_var_name('facebook-section');

				$KTT_new_setting = new KTT_new_setting($args);



				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('facebook_comments_load_number');
				$args['option_name']            = __('Number of comments', THEME_TEXTDOMAIN);
				$args['option_label']           = sprintf(__("", THEME_TEXTDOMAIN));;
				$args['option_description']     = sprintf(__("Number of comments to load by default.", THEME_TEXTDOMAIN));;
				$args['option_type']            = 'text';
				$args['option_default'] 		= '10';
				$args['option_order']			= 5;
				$args['option_page']            = ktt_var_name('thirdpary-comments-page');
				$args['option_page_section'] 	= ktt_var_name('facebook-section');

				$KTT_new_setting = new KTT_new_setting($args);


				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('facebook_comments_order');
				$args['option_name']            = __('Comments order', THEME_TEXTDOMAIN);
				$args['option_label']           = sprintf(__("", THEME_TEXTDOMAIN));;
				$args['option_description']     = sprintf(__("The order to use when displaying comments.", THEME_TEXTDOMAIN));;
				$args['option_type']            = 'select';
				$args['option_type_vars']		= array(
													'social' => __('Social relevance',THEME_TEXTDOMAIN),
													'reverse_time' => __('Recents first', THEME_TEXTDOMAIN),
													'time' => __('Older first',THEME_TEXTDOMAIN)
												);
				$args['option_default'] 		= 'social';
				$args['option_order']			= 6;
				$args['option_page']            = ktt_var_name('thirdpary-comments-page');
				$args['option_page_section'] 	= ktt_var_name('facebook-section');

				$KTT_new_setting = new KTT_new_setting($args);


}

?>