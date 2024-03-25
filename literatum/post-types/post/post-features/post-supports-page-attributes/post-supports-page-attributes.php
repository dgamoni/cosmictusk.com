<?php
/**
* Este script habilita los atributos de página para los posts.
* esto permite que en el editor de post se pueda elegir una template
*/

/**
* este filter permite modificar el comportamiento de las templates para un psot
* aprovechamos esto para modificar la template que carga el post
*/
function KTT_post_load_custom_template($template){

      /**
      * Si no estamos en una pagina single post entonces salimos de aqui
      * devolviendo la template que ya trajera de por si
      */
      if( !is_single() ) return $template;

      /**
      * Cargamos la query actual
      */
      global $wp_query;

      /**
      * Si el post tiene una template personalizada estara guardada en su postmeta
      * wp_page_template, si es asi sustituimos dicha template por la actual
      */
      $custom_template = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

      /**
      * Devolvemos la template si la tuviera
      */
      return empty( $c_template ) ? $template : $custom_template;

}
add_filter( 'template_include', 'KTT_post_load_custom_template' );




/**
* Habilitamos los atributos de pagina en los posts
*/
function KTT_page_attributes_for_posts(){add_post_type_support( 'post', 'page-attributes' );}
add_action( 'init', 'KTT_page_attributes_for_posts' );


 ?>
