<?php
/**
* Crea un metabox para poder introducir un titulo con formato a la entrada
*/

/**
* Creation of the metabox_id with the hyper-amazing KTT Framework
*/
$args = array();
$args['metabox_id'] 					= 	'post_title_formated';
$args['metabox_name']					= 	__("Title", THEME_TEXTDOMAIN);
$args['metabox_post_type'] 		= 	'post';
$args['metabox_vars'] 				= 	array(
                                      ktt_var_name('post_title_formated')
                                  );
$args['metabox_callback']			= 	'KTT_post_title_meta_box';
$args['metabox_context']			= 	'advanced';
$args['metabox_priority']			= 	'high';
$metabox = new KTT_new_metabox($args);



/**
* Metabox render
*/
function KTT_post_title_meta_box($post) {

    /**
    * Si actualmente la entrada no dispone de un titulo con formato ponemos
    * por defecto el titulo normal de la entrada.
    */
    if (!isset($post->post_title_formated)) $post->post_title_formated = $post->post_title;

    /**
    * Declaramos la configuración de nuestro editor
    */
    $editor_settings = array(
                                      'wpautop' => true,
                                      'media_buttons' => false,
                                      'textarea_name' => ktt_var_name('post_title_formated'),
                                      'textarea_rows' => 0,
                                      //'teeny' 	=> true,
                                      'quicktags' => false,
                                      'tinymce' => array(
                                                'toolbar1'=> 'bold,italic,underline,link,unlink,forecolor'
                                        )
    );

    ?>
    <div id="titlediv">
      <p>
        <?php _e('Insert a title for your post. You can use format tags.', THEME_TEXTDOMAIN);?>
      </p>
    <?php

    /**
    * Creamos el editor
    */
    wp_editor( $post->post_title_formated, ktt_var_name('post_title_formated'), $editor_settings );




      /**
      * Post name / slug / permalink magic
      */
      global $post_type, $post_type_object;
      $sample_permalink_html = $post_type_object->public ? get_sample_permalink_html($post->ID) : '';

    	if ( $post_type_object->public && ! ( 'pending' == get_post_status( $post ) && !current_user_can( $post_type_object->cap->publish_posts ) ) ) {
    	        $has_sample_permalink = $sample_permalink_html && 'auto-draft' != $post->post_status;
    	?>
    	        <div id="edit-slug-box" class="hide-if-no-js">
    	        <?php
    	                if ( $has_sample_permalink ) echo $sample_permalink_html;
    	        ?>
    	        </div>
    	<?php
    	}
      wp_nonce_field( 'samplepermalink', 'samplepermalinknonce', false );


    ?>
    </div>
    <?php
}







/***
* Nos aseguramos de capturar el hook que se ejecuta cada vez que se guarda un postmeta para en
* este caso actualizar el title del post en base al post_title_formated que hemos guardado
*/
function KTT_update_post_title_from_formated($meta_id, $post_id, $meta_key, $meta_value) {

      /**
      * Si no es el meta que estamos buscando o no se ha indicado un valor salimos de aqui
      */
      if ( $meta_key != ktt_var_name('post_title_formated'))  return;
      if (!$meta_value) return;

      /**
      * el meta_value es el texto con formato, debemos sanetizarlo para eliminar tags html
      */
      $meta_value = wp_strip_all_tags($meta_value, true);

      /**
      * Actualizamos el post al que pertenece este postmeta para cambiarle el title
      */
      KTT_change_post_field($post_id, 'post_title', $meta_value);

      /**
      * Con esto nos aseguramos de poner un permalink correcto en el caso en el que el Post
      * se este publicando por primera vez (en lugar de un update)
      */
      $post = KTT_get_post($post_id);
      if ($post->post_name == 'auto-draft')  KTT_change_post_field($post_id, 'post_name', sanitize_title($meta_value));

}
add_action( 'added_post_meta', 'KTT_update_post_title_from_formated', 5, 4 );
add_action( 'updated_post_meta', 'KTT_update_post_title_from_formated', 5, 4 );
