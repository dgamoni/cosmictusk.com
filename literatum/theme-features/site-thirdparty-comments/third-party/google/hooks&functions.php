<?php
/**
 * hook and functions for disqus support
 *
 */





//return the comments template path
function KTT_get_comments_template_path() {
	return dirname(__FILE__) . '/comments-template.php';
}




// render the javascript needed to display the comment count on the posts
add_action('wp_footer', 'KTT_google_comments_count_js');
function KTT_google_comments_count_js() {
	//$facebook_comments_app_id = get_option(ktt_var_name('facebook_comments_app_id'));
	

	?>
	 <script src="https://apis.google.com/js/plusone.js"></script>
	<?php
}





// create the comments count link indicator
function KTT_display_comments_count() {
	global $post;
	?>
	<a class="comments "  href="<?php echo get_permalink();?>#comments"><div id="commentscounter" style="display:inline-block" class="gXXX-commentcount" data-href="<?php echo get_permalink($post->ID);?>"></div> <?php _e('View comments', THEME_TEXTDOMAIN);?></a>
	<?php
}





// reload the comments count for ajax loading content
add_action('KTT_after_ajax_link_load', 'KTT_google_reload_comments_count_js');
function KTT_google_reload_comments_count_js() {
	
	/*
	// this is javascript code
	?>
	gapi.commentcount.render('commentscounter', {
    href: window.location
	});
	<?php
	*/
}



?>