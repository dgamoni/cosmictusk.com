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
add_action('wp_footer', 'KTT_facebook_comments_count_js');
function KTT_facebook_comments_count_js() {
	$facebook_comments_app_id = get_option(ktt_var_name('facebook_comments_app_id'));
	

	?>
	 <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&appId=<?php echo $facebook_comments_app_id;?>&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<?php
}





// create the comments count link indicator
function KTT_display_comments_count() {
	global $post;
	?>
	<a class="comments comments_count" href="<?php echo get_permalink();?>#comments"><div style="display:inline-block" class="fb-comments-count" data-href="<?php echo get_permalink($post->ID);?>">0</div> <?php _e('Comments', THEME_TEXTDOMAIN);?></a>
	<?php
}





// reload the comments count for ajax loading content
add_action('KTT_after_ajax_link_load', 'KTT_facebook_reload_comments_count_js');
function KTT_facebook_reload_comments_count_js() {
	

	// this is javascript code
	?>
	FB.XFBML.parse();
	<?php
}



?>