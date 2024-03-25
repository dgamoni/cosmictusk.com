<?php






/**
* Esta funcion se encarga de devolver la imagen featured de una category
*/
function KTT_get_category_featured_image_id($category_id) {

    /**
    * En result vamos a guardar el resultados
    */
    $result = 0;

    /**
    * Obtenemos la imagen a partir del meta
    */
    $result = get_taxonomy_meta($category_id, ktt_var_name('category_featured_image'), true);
    if (!$result) $result = get_taxonomy_meta($category_id, ktt_var_name('tag_featured_image'), true);

    /**
    * Si tenemos un result salimos de aqui con el resultados
    */
    if ($result) return $result;

    /**
    * Si hemos llegado hasta aqui vamos a intentar obtener la imagen de los posts
    * que actualmente estamos requesting
    */
    $attach_from_posts = KTT_get_featured_image_from_current_posts();
    if ($attach_from_posts) return $attach_from_posts;

    /**
    * Si hemos llegado hasta aqui significa que no hemos encontrado imagen, por lo tanto vamos a tratar
    * de obtener una imagen a traves de un tag
    */
    return KTT_get_tag_featured_image_id($category_id);

}





/**
* Esta funcion se encarga de devolver una imagen deatured vinculada a un tag
*/
function KTT_get_tag_featured_image_id($tag_id) {
    /**
    * En result vamos a guardar el resultados
    */
    $result = 0;

    /**
    * Obtenemos la imagen a partir del meta
    */
    $result = get_taxonomy_meta($tag_id, ktt_var_name('tag_featured_image'), true);

    /**
    * Si tenemos un result salimos de aqui con el resultados
    */
    if ($result) return $result;

    /**
    * Si hemos llegado hasta aqui significa que la categoria no tiene imagen definida, por lo tanto
    * vamos a obtener los ultimos 10-15 posts pertenecientes a la categoria y a extraer
    * la imagen destacada de alguno de sus posts para utilizarla como imagen de la categoria
    */
    $args = array('post_type' => 'post', 'post_status' => 'publish', 'tag_id' => $tag_id, 'posts_per_page' => 15);
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
* Esta funcion se encarga de extraer la template de una categoria
*/
function KTT_get_category_template($category_id = '') {

    if (!$category_id) $category_id = get_queried_object()->term_id;

    /**
    * En result obtenemos la id
    */
    $template_id = get_term_meta($category_id, ktt_var_name('category_template'), true);

    /**
    * Si no hemos obtenido una id de template entonces vamos a comprobar si el theme tiene definida
    * una por defecto para las categorias que no la tengan
    */
    if (!$template_id) $template_id = get_option(ktt_var_name('category_template'));

    /**
    * Si a estas alturas seguimos sin template id vamos a obtener la lista compelta y nos quedamos
    * con la primera
    */
    if (!$template_id) {

        /**
        * lista de templates
        */
        $templates = KTT_get_theme_templates_by_type('category');

        /**
        * Nos quedamos solo con el primer valor
        */
        $t = reset($templates);
        $template_id = $t->id;

    }

    /**
    * Obtenemos el objeto template_id
    */
    $template = KTT_get_theme_template($template_id);

    /**
    * Devovlemos la template
    */
    return $template;


}


 ?>
