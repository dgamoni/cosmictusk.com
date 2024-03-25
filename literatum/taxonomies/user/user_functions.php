<?php
/**
* Funciones relacionadas con los usuarios
*/



/**
* Esta funcion se encarga de devolver la imagen featured de un usuario
* esta es la imagen que se utilizara como fondo en la pagina de author y demas
*/
function KTT_get_user_avatar_id($user_id) {

    /**
    * Obtenemos la imagen a partir del meta
    */
    $avatar_id = get_user_meta($user_id, ktt_var_name('user_avatar'), true);

    /**
    * Si tenemos un result salimos de aqui con el resultado
    */
    if ($avatar_id) return $avatar_id;

}



/**
* Esta funcion se encarga de devolver la imagen featured de un usuario
* esta es la imagen que se utilizara como fondo en la pagina de author y demas
*/
function KTT_get_user_featured_image_id($user_id = '') {

    if (!$user_id) $user_id = get_query_var( 'author' );

    /**
    * En result vamos a guardar el resultados
    */
    $result = 0;

    /**
    * Obtenemos la imagen a partir del meta
    */
    $result = get_user_meta($user_id, ktt_var_name('user_featured_image'), true);
    if (!$result) $result = get_user_meta($user_id, ktt_var_name('profile_background_image'), true);


    /**
    * Si tenemos un result salimos de aqui con el resultados
    */
    if ($result) return $result;

    /**
    * Si hemos llegado hasta aqui significa que la categoria no tiene imagen definida, por lo tanto
    * vamos a obtener los ultimos 10-15 posts pertenecientes a la categoria y a extraer
    * la imagen destacada de alguno de sus posts para utilizarla como imagen de la categoria
    */
    $args = array('post_type' => 'post', 'post_status' => 'publish', 'post_author' => $user_id, 'posts_per_page' => 15);
    $q = new WP_Query($args);
    $posts = $q->posts;

    // RANDOM!
    if ($posts) shuffle($posts);

    /**
    * Itineramos por cada post y extraemos la primera featured image que encontremos
    */
    if ($posts) foreach ($posts as $post) {
        $attach_id = get_post_thumbnail_id($post->ID);
        if ($attach_id) return $attach_id;
    }

}





/**
* Esta funcion se encarga de obtener solo la id de la template que esta usando un post
*/
function KTT_get_user_template_id($user) {

   if (is_int($user) || is_string($user)) $user = KTT_get_user_by('ID', $user);

   /**
   * Intentamos obtener la id de template que tiene vinculada el post si la hubiere
   */
   $template_id = '';
   if (isset($user->data->user_template)) $template_id = $user->data->user_template;

   /**
   * Si no hemos encontrado ninguna template vinculada buscamos si el theme tiene definida
   * alguna en sus opciones para los posts
   */
   if (!$template_id) $template_id = KTT_get_theme_option('user_template');

   /**
   * Si a estas alturas no tenemos template id vamos a obtener la lista de
   * todas las templates para los posts y nos quedamos con la primera que encontremos
   */
   if (!$template_id) {

       /**
       * Obtenemos la lista de templates disponibles para un post
       */
       $templates = KTT_get_theme_templates_by_type('user');

       /**
       * Nos quedamos con la primera de la lista
       */
       $template_id = array_values($templates)[0]->id;

   }

   /**
   * Devolvemos la template id
   */
   return $template_id;


}


/**
* Esta funcion se encarga de obtener la template que le corresponde a un post
*/
function KTT_get_user_template($user = '') {

   if (!$user) $user = get_query_var( 'author' );

   if (is_int($user) || is_string($user)) $user = KTT_get_user_by('ID', $user);

   /**
   * Obtenemos la lista de templates disponibles para un post
   */
   $templates = KTT_get_theme_templates_by_type('user');

   /**
   * Si no hay templates salimos de aqui
   */
   if (!$templates) return;

   /**
   * Intentamos obtener la id de template que tiene vinculada el post si la hubiere
   */
   $template_id = KTT_get_user_template_id($user);

   /**
   * Devolvemos el objeto template
   */
   return $templates[$template_id];

}










?>
