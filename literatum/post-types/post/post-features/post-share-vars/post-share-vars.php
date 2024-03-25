<?php
/**
 * share vars for $post object.
 *
 */


// add "share this" variables right in the $post object
add_action( 'wp', 'KTT_share_args_for_posts' );
function KTT_share_args_for_posts()
{

    global $post;
    if(!$post) return;


    // we get the image urls -------------------------------------------------------------
    $post_image_id = get_post_thumbnail_id( $post->ID );

    $post_image_url_thumb = '';
    $post_image_url_medium = '';
    $post_image_url_large = '';

    if ($post_image_id) {


	    $post_image_url_thumb = wp_get_attachment_image_src( $post_image_id, 'thumbnail' );
	    $post_image_url_thumb = $post_image_url_thumb[0];

	    $post_image_url_medium = wp_get_attachment_image_src( $post_image_id, 'medium' );
	    $post_image_url_medium = $post_image_url_medium[0];

	    $post_image_url_large = wp_get_attachment_image_src( $post_image_id, 'large' );
	    $post_image_url_large = $post_image_url_large[0];
	}

    // -----------------------------------------------------------------------------------


    // get the excerpt -------------------------------------------------------------------
    $excerpt = substr($post->post_excerpt, 0, 195);
    if (!$excerpt) $excerpt = substr(wp_strip_all_tags(do_shortcode($post->post_content)), 0, 195);
    $excerpt .= '...';
    // -----------------------------------------------------------------------------------

    global $wpdb;
    $title = str_replace('|', '', $post->post_title);
    $title = rawurlencode($title);


    $share_args = array();
    $share_args['url'] 					=  	get_permalink($post->ID);
    $share_args['title'] 				= 	$title;
	  $share_args['text'] 				= 	$title;

	  $share_args['description'] 			= 	$excerpt;

	  $share_args['image']['thumb'] 		= 	$post_image_url_thumb;
	  $share_args['image']['medium'] 		= 	$post_image_url_medium;
	  $share_args['image']['large'] 		= 	$post_image_url_large;

    $post->share = $share_args;

}





// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {

                // create a page to inset the social media vars of the main site
                // add page to theme options

                $args = array();
                $args['id'] = ktt_var_name('social-media-site-page');
                $args['page_title'] = 'Social Media';
                $args['page_description'] = __('Fill this fields to make the site and the articles fully shareables in social media sites.', THEME_TEXTDOMAIN);
                $args['menu_title'] = 'Social Media';
                $args['menu_order'] = 3;
                $args['parent'] = 'theme-options';

                $new_admin_submenu = new KTT_admin_submenu($args);

}






// Create the header elements necesssary to share correctly a post in the principal social nets

// share to twitter
include('share-to-twitter.php');

// share to facebook
include('share-to-facebook.php');
