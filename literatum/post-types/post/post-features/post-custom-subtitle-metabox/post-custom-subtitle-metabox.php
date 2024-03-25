<?php
/**
* Crea un metabox para poder introducir un subtitilo de entrada
*/

/**
* Creation of the metabox_id with the hyper-amazing KTT Framework
*/
$args = array();
$args['metabox_id'] 					= 	'post_subtitle_formated';
$args['metabox_name']					= 	__("Subtitle", THEME_TEXTDOMAIN);
$args['metabox_post_type'] 		= 	'post';
$args['metabox_vars'] 				= 	array(
                                      ktt_var_name('post_subtitle_formated')
                                  );
$args['metabox_callback']			= 	'KTT_post_subtitle_meta_box';
$args['metabox_context']			= 	'advanced';
$args['metabox_priority']			= 	'low';
$metabox = new KTT_new_metabox($args);





function myplugin_tinymce_buttons( $buttons ) {
  return array('bold', 'italic', 'underline', 'strikethrough');
}
//add_filter( 'mce_buttons', 'myplugin_tinymce_buttons' );



/**
* Metabox render
*/
function KTT_post_subtitle_meta_box($post) {

    /**
    * Obtenemos el subtitle si lo hubiere
    */
    $post_subtitle = KTT_get_the_subtitle($post);

    /**
    * Declaramos la configuración de nuestro editor
    */
    $editor_settings = array(
                                      'wpautop' => true,
                                      'media_buttons' => false,
                                      'textarea_name' => ktt_var_name('post_subtitle_formated'),
                                      'textarea_rows' => 0,
                                      //'teeny' 	=> true,
                                      'quicktags' => false,
                                      'tinymce' => array(
                                                'toolbar1'=> 'bold,italic,underline,link,unlink,forecolor'
                                        )
    );

    ?>
      <p>
        <?php _e('Insert a subtitle for your post. You can use format tags.', THEME_TEXTDOMAIN);?>
      </p>
    <?php

    /**
    * Creamos el editor
    */
    wp_editor( $post_subtitle, ktt_var_name('post_subtitle_formated'), $editor_settings );

}





/***
* Nos aseguramos de capturar el hook que se ejecuta cada vez que se guarda un postmeta para en
* este caso actualizar el subtitle del post en base al post_subtitle_formated que hemos guardado
* y asi tener dos versiones del mismo, una con formato y otra sin él.
*/
function KTT_update_post_subtitle_from_formated($meta_id, $post_id, $meta_key, $meta_value) {

      /**
      * Si no es el meta que estamos buscando o no se ha indicado un valor salimos de aqui
      */
      if ( $meta_key != ktt_var_name('post_subtitle_formated'))  return;

      /**
      * el meta_value es el texto con formato, debemos sanetizarlo para eliminar tags html
      */
      $meta_value = wp_strip_all_tags($meta_value, true);

      /**
      * Actualizamos el post al que pertenece este postmeta para cambiarle el title
      */
      update_post_meta($post_id, ktt_var_name('post_subtitle'), $meta_value);

}
add_action( 'added_post_meta', 'KTT_update_post_subtitle_from_formated', 5, 4 );
add_action( 'updated_post_meta', 'KTT_update_post_subtitle_from_formated', 5, 4 );

?>
