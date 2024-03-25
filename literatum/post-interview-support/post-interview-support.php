<?php
/**
 * Interview support for articles.
 *
 */






// interview metabox for single posts

add_action( 'add_meta_boxes', 'KTT_adding_interview_metabox', 10, 2 );
function KTT_adding_interview_metabox( $post_type, $post ) {
add_meta_box("KTT_interview_metabox", __("Interview variables",THEME_TEXTDOMAIN), "KTT_interview_metabox", "post", "normal", "high");
};
function KTT_interview_metabox() {
  	global $post;

  	$interview_interviewer = '';
  	$interview_interviewed = '';

  	if ($post->interview) {
  		$interview_interviewer = $post->interview['interviewer']; 
  		$interview_interviewed = $post->interview['interviewed'];
  	}
  	

  ?> 
  
  <p>
  	<?php _e('If this article includes an interview and special controls have been used to enter questions and answers, complete the following fields.', THEME_TEXTDOMAIN);?>
  </p>

<table class="form-table">
	<tr valign="top">
		<th ><?php _e('Interviewer',THEME_TEXTDOMAIN)?>
			<p class="description"><?php _e('insert the name of the <b>interviewer</b>',THEME_TEXTDOMAIN)?></p>
		</th>
		<td>
			<fieldset>
			
				<input type="text" name="interview_interviewer" value="<?php echo $interview_interviewer;?>">
				
			</fieldset>
		</td>
	</tr>

	<tr valign="top">
		<th ><?php _e('Interviewed',THEME_TEXTDOMAIN)?>
			<p class="description"><?php _e('insert the name of the <b>interviewed</b>',THEME_TEXTDOMAIN)?></p>
		</th>
		<td>
			<fieldset>
			
				<input type="text" name="interview_interviewed" value="<?php echo $interview_interviewed;?>">
				
			</fieldset>
		</td>
	</tr>


</table>

  <?php
  
}



// save the metabox fields

add_action('save_post', 'KTT_save_interview_vars');
function KTT_save_interview_vars(){
  	global $post;
  	if ($post) {
  	if ($post->post_type=="post") {
  	
	  	$post_id = $post->ID;
	  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
			return $post_id;

	  	update_post_meta($post->ID, "interview_interviewer", @$_POST["interview_interviewer"]);
	  	update_post_meta($post->ID, "interview_interviewed", @$_POST["interview_interviewed"]);

  	}
  	}
  
} 








// load the interviews variables in the $psot object

add_action( 'admin_head', 'KTT_interview_vars_for_posts' ); // for administration pages
add_action( 'wp', 'KTT_interview_vars_for_posts' ); // for the public site
function KTT_interview_vars_for_posts()
{

    global $post;
    if(!$post) return;

    $interview_interviewer = get_post_meta($post->ID, "interview_interviewer", true);
    $interview_interviewed = get_post_meta($post->ID, "interview_interviewed", true);

    if ($interview_interviewer || $interview_interviewed) {

	    $args = array();
	    $args['interviewer'] 		=  	$interview_interviewer;
		$args['interviewed'] 		= 	$interview_interviewed;

	    $post->interview = $args;

	}

}






// add the css style for interview in the article page

add_filter('the_content', 'KTT_print_css_interview_style');
function KTT_print_css_interview_style($content) {

	if (is_single()) {


		global $post;
		if ($post->interview) {?>
		<style>

			.question:before {
			  content:'<?php _e('Question',THEME_TEXTDOMAIN);?>';
			}
			.answer:before {
			content:'<?php _e('Answer',THEME_TEXTDOMAIN);?>';
			}


			<?php if ($post->interview['interviewer']) {?>
			.question:before {
			  	content:'<?php echo $post->interview['interviewer'];?>';
			}
			<?php } ?>

			<?php if ($post->interview['interviewed']) { ?>
			.answer:before {
				content:'<?php echo $post->interview['interviewed'];?>';
			}
			<?php } ?>

		</style>
		<?php } 

	}

	return $content;

}







// add the buttons to editor
include('interview-buttons-shortcode.php');



