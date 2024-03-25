<?php




// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add page to theme options

				$args = array();
				$args['id'] 				= ktt_var_name('readtime-page');
				$args['page_title'] 		= __('Read Time',THEME_TEXTDOMAIN);
				$args['page_description'] 	= __('', THEME_TEXTDOMAIN);
				$args['menu_title'] 		= __('Read Time',THEME_TEXTDOMAIN);
				$args['menu_order'] 		= 10;
				$args['parent'] 			= 'theme-options';

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section for read time

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('read_time');
				$args['section_name']            	= __('Read Time for articles', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the Read Time option for articles.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('readtime-page');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_show_read_time');
				$args['option_name']            = __('Display Read Time', THEME_TEXTDOMAIN);
				$args['option_label']           = __('Active the display of the read time option in the articles.', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Check this option if you want to active read time',THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkbox';
				$args['option_page']            = ktt_var_name('readtime-page');
				$args['option_page_section']    = ktt_var_name('read_time');
				$args['option_default']			= '1';

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_read_time_type');
				$args['option_name']            = __('Display Type', THEME_TEXTDOMAIN);
				$args['option_label']           = __('Choose display type.', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select between display the read time or the number of words.',THEME_TEXTDOMAIN);
				$args['option_type']            = 'select';
				$args['option_type_vars']       = array(
													'read_time' => __('Read time',THEME_TEXTDOMAIN),
													'words_count' => __('Words count',THEME_TEXTDOMAIN)
												);
				$args['option_page']            = ktt_var_name('readtime-page');
				$args['option_page_section']    = ktt_var_name('read_time');
				$args['option_default']			= 'read_time';

				$KTT_new_setting = new KTT_new_setting($args);

}


?>
