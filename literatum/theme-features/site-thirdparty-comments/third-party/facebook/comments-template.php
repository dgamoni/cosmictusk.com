<?php
/**
 * template for comments
 *
 */


$facebook_comments_load_number = get_option(ktt_var_name('facebook_comments_load_number'));
$facebook_comments_order = get_option(ktt_var_name('facebook_comments_order'));

?>


<div class="fb-comments" data-width="100%" data-href="<?php echo get_permalink($post->ID);?>" data-numposts="<?php echo $facebook_comments_load_number;?>" data-colorscheme="light"></div>





