<?php
/**
 * share vars (and more) for twittter
 *
 */




// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('site_twitter');
				$args['option_name']            = __('Site Twitter', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = sprintf(__('Add the username of %s in Twitter. (without @)', THEME_TEXTDOMAIN), get_bloginfo('name'));
				$args['option_type']            = 'text';
				$args['option_page']            = ktt_var_name('social-media-site-page');

				$KTT_new_setting = new KTT_new_setting($args);

}









// add "share this" variables right in the $post object
add_action( 'wp', 'KTT_share_args_for_posts_TWITTER' );
if (!function_exists('KTT_share_args_for_posts_TWITTER')) {
function KTT_share_args_for_posts_TWITTER()
{

    global $post;
    if(!$post) return;


     // twitter username of the website -----------------------------------------------
    $site_twitter = get_option(ktt_var_name('site_twitter'));
    // --------------------------------------------------------------------------------


    // twitter username of the post author --------------------------------------------
    $author_twitter = get_the_author_meta( 'twitter', $post->post_author );
    if (!$author_twitter) $author_twitter = $site_twitter;
    // --------------------------------------------------------------------------------


	$share_args['twitter']['via'] 					= 	$site_twitter;
	$share_args['twitter']['related'] 				= 	$author_twitter;
	$share_args['twitter']['hashtags'] 				= 	'';
	$share_args['twitter']['site_twitter'] 			= 	$site_twitter;
	$share_args['twitter']['author_twitter'] 		= 	$author_twitter;

    $post->share = array_merge($post->share, $share_args);


}
}





// Twitter card (summary card with large image)
add_action( 'wp_head', 'KTT_shareable_header_twitter_card' );
if (!function_exists('KTT_shareable_header_twitter_card')) {
function KTT_shareable_header_twitter_card() {

	global $post;
    if(!$post) return;


		?>
		<meta name="twitter:card" 			content="summary_large_image">
		<meta name="twitter:site" 			content="@<?php echo $post->share['twitter']['site_twitter'];?>">
		<meta name="twitter:creator" 		content="@<?php echo $post->share['twitter']['author_twitter'];?>">
		<meta name="twitter:title" 			content="<?php echo htmlspecialchars(rawurldecode($post->share['title']));?>">
		<meta name="twitter:description" 	content="<?php echo $post->share['description'];?>">
		<meta name="twitter:domain" 		content="<?php echo home_url();?>">
		<meta name="twitter:image:src" 		content="<?php echo $post->share['image']['large'];?>">
		<?php


}
}
