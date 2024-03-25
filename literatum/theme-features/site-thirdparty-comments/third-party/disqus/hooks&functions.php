<?php
/**
 * hook and functions for disqus support
 *
 */





//return the comments template path
function KTT_get_comments_template_path() {
	return dirname(__FILE__). '/comments-template.php';
}




// render the javascript needed to display the comment count on the posts
add_action('wp_footer', 'KTT_disqus_comments_count_js');
function KTT_disqus_comments_count_js() {
	$disqus_shortname = get_option(ktt_var_name('disqus_shortname'));
	if (!$disqus_shortname) return;

	?>
	 <script type="text/javascript">
    var disqus_shortname = '<?php echo $disqus_shortname;?>';
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script>
	<?php
}





// create the comments count link indicator
function KTT_display_comments_count() {
	global $post;
	?>
	<a class="comments comments_count" href="<?php echo get_permalink();?>#disqus_thread">0 Comments</a>
	<?php
}





// reload the comments count for ajax loading content
add_action('KTT_after_ajax_link_load', 'KTT_disqus_reload_comments_count_js');
function KTT_disqus_reload_comments_count_js() {
	$disqus_shortname = get_option(ktt_var_name('disqus_shortname'));
	if(!$disqus_shortname) return;

	// this is javascript code
	?>
	window.DISQUSWIDGETS = undefined;
	jQuery.getScript("http://<?php echo $disqus_shortname;?>.disqus.com/count.js");
	<?php
}



?>