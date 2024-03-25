<?php
/**
 * Add a new field in the post editor to add photo credit for featured images.
 *
 */





 /**
 * Creation of the metabox_id with the hyper-amazing KTT Framework
 */
 $args = array();
 $args['metabox_id'] 						= 	'post_credits';
 $args['metabox_name']					= 	__("Post Credits", THEME_TEXTDOMAIN);
 $args['metabox_post_type'] 		= 	'post';
 $args['metabox_vars'] 					= 	array(
                                       ktt_var_name('post_credits')
                                   );
 $args['metabox_callback']			= 	'KTT_post_credits_meta_box';
 $args['metabox_context']				= 	'side';
 $args['metabox_priority']			= 	'default';
 $metabox = new KTT_new_metabox($args);






// META BOX FORM
function KTT_post_credits_meta_box( $post ) {

    $credit = get_post_meta($post->ID, ktt_var_name('post_credits'), true);

    $settings = array(
    	'wpautop' => false,
    	'media_buttons' => false,
    	'textarea_name' => ktt_var_name('post_credits'),
    	'textarea_rows' => 5,
    	//'teeny' 	=> true,
    	'quicktags' => false,
    	'tinymce' => array(
        				'toolbar1'=> 'bold,italic,underline,link,unlink,forecolor'
      	),

    );

    ?>

    <p><?php _e("If necessary, insert credits for this post. This field is useful to add image credits and post's copyright related stuff.",THEME_TEXTDOMAIN);?></p>
    <?php
    wp_editor( $credit, ktt_var_name('post_credits'), $settings );
}



?>
