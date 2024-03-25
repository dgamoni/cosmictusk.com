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
				$args['section_id']              	= ktt_var_name('dusqus-section');
				$args['section_name']            	= __('Disqus configuration', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Fill the fileds with your Disqus information.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('thirdpary-comments-page');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('disqus_shortname');
				$args['option_name']            = __('Disqus shortname', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = sprintf(__("Tells the Disqus service your forum's shortname, which is the unique identifier for your website as registered on Disqus. If undefined, the Disqus embed will not load.", THEME_TEXTDOMAIN), get_bloginfo('name'));;
				$args['option_type']            = 'text';
				$args['option_default'] 		= '';
				$args['option_order']			= 2;
				$args['option_page']            = ktt_var_name('thirdpary-comments-page');
				$args['option_page_section'] 	= ktt_var_name('dusqus-section');

				$KTT_new_setting = new KTT_new_setting($args);



				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('disqus_disable_mobile');
				$args['option_name']            = __('Disable mobile', THEME_TEXTDOMAIN);
				$args['option_label']           = sprintf(__("Tells the Disqus service to never use the mobile optimized version of Disqus.", THEME_TEXTDOMAIN));;
				$args['option_description']     = sprintf(__("", THEME_TEXTDOMAIN));;
				$args['option_type']            = 'checkbox';
				$args['option_default'] 		= '';
				$args['option_order']			= 3;
				$args['option_page']            = ktt_var_name('thirdpary-comments-page');
				$args['option_page_section'] 	= ktt_var_name('dusqus-section');

				$KTT_new_setting = new KTT_new_setting($args);

}

?>