<?php
/**
 * Add third party comments support
 *
 */





// get the current comments system
function KTT_get_comments_system() {
	$comments_system = get_option(ktt_var_name('comments_system'));
	if(!$comments_system) $comments_system = 'wordpress';
	return $comments_system;
}





// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add page to theme options

				$args = array();
				$args['id'] = ktt_var_name('thirdpary-comments-page');
				$args['page_title'] = __('Comments',THEME_TEXTDOMAIN);
				$args['page_description'] = sprintf(__('Comments settings for %s.', THEME_TEXTDOMAIN), get_bloginfo('name'));
				$args['menu_title'] = __('Comments',THEME_TEXTDOMAIN);
				$args['menu_order'] = 3;
				$args['parent'] = 'theme-options';

				$new_admin_submenu = new KTT_admin_submenu($args);






				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('comments_system');
				$args['option_name']            = __('Comments system', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = sprintf(__('Select what type of comments system you want to use in %s.', THEME_TEXTDOMAIN), get_bloginfo('name'));;
				$args['option_type']            = 'select';
				$args['option_type_vars']       = array(
													'wordpress' => 'Wordpress',
													'disqus' => 'Disqus',
													'facebook' => 'Facebook comments',
													'google' => 'Google+ comments'
													);
				$args['option_default'] 		= 'wordpress';
				$args['option_order']			= 1;
				$args['option_page']            = ktt_var_name('thirdpary-comments-page');

				$KTT_new_setting = new KTT_new_setting($args);


}




include('third-party/disqus/disqus.php');
include('third-party/facebook/facebook.php');
include('third-party/google/google.php');







// if the site is not using wordpress comments, alert in settings/comments
// coming soon


?>