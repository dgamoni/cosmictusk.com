<?php
/**
 * Interview support for articles.
 *
 */


 /**
 * Creation of the metabox_id with the hyper-amazing KTT Framework
 */
 $args = array();
 $args['metabox_id'] 					   = 	'post_interview';
 $args['metabox_name']					 = 	__("Interview", THEME_TEXTDOMAIN);
 $args['metabox_post_type'] 		 = 	'post';
 $args['metabox_vars'] 				   = 	array(
                                       ktt_var_name('post_interview_interviewer'),
                                       ktt_var_name('post_interview_interviewed')
                                   );
 $args['metabox_callback']       = 	'KTT_interview_metabox';
 $args['metabox_context']			   = 	'normal';
 $args['metabox_priority']		   = 	'high';
 $metabox = new KTT_new_metabox($args);




/**
* Interview metabox
*/
function KTT_interview_metabox($post) {

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

    				<input type="text" name="<?php echo ktt_var_name('post_interview_interviewer');?>" value="<?php echo $post->post_interview_interviewer;?>">

    			</fieldset>
    		</td>
    	</tr>

    	<tr valign="top">
    		<th ><?php _e('Interviewed',THEME_TEXTDOMAIN)?>
    			<p class="description"><?php _e('insert the name of the <b>interviewed</b>',THEME_TEXTDOMAIN)?></p>
    		</th>
    		<td>
    			<fieldset>

    				<input type="text" name="<?php echo ktt_var_name('post_interview_interviewed');?>" value="<?php echo $post->post_interview_interviewed;?>">

    			</fieldset>
    		</td>
    	</tr>


    </table>

    <?php

}








// add the css style for interview in the article page

add_filter('the_content', 'KTT_print_css_interview_style');
function KTT_print_css_interview_style($content) {


	if (is_single()) {

		global $post;
		if (isset($post->post_interview_interviewed) && $post->post_interview_interviewed) {?>
		<style>

      .question:before, .answer:before {
        position:absolute;
        width:200px;
        text-align:right;
        margin-left:-220px;
        font-size:0.65em;
        font-weight:200;
      }

      @media  screen and (min-width : 0px) and (max-width : 768px) {
        .question:before, .answer:before {
          position:relative;
          display:block;
          text-align:left;
          margin:0;
        }
      }

			.question:before {
			     content:'<?php _e('Question',THEME_TEXTDOMAIN);?>';
			}
			.answer:before {
			     content:'<?php _e('Answer',THEME_TEXTDOMAIN);?>';
			}


			<?php if ($post->post_interview_interviewer) {?>
			.question:before {
			  	content:'<?php echo $post->post_interview_interviewer;?>';
			}
			<?php } ?>

			<?php if ($post->post_interview_interviewed) { ?>
			.answer:before {
				content:'<?php echo $post->post_interview_interviewed;?>';
			}
			<?php } ?>

		</style>
		<?php }

	}

	return $content;

}







// add the buttons to editor
include('interview-buttons-shortcode.php');
