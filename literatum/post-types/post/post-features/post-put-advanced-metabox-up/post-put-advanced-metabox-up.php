<?php
/**
* Este script se encarga de poner los metaboxes en el contexto "advanced" por delante del
* editor de texto principal en la edicion de una entrada
*/
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'advanced', $post);
    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});
