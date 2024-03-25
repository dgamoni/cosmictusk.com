<?php
/**
* Este script permite añadir soporte para multiples authores
*/


/**
* Creation of the metabox_id with the hyper-amazing KTT Framework
*/
$args = array();
$args['metabox_id'] 					= 	'post_coauthors';
$args['metabox_name']					= 	__("Post Co-Authors", THEME_TEXTDOMAIN);
$args['metabox_post_type'] 		= 	'post';
$args['metabox_vars'] 				= 	array(
                                      ktt_var_name('post_coauthors')
                                  );
$args['metabox_callback']			= 	'KTT_post_coauthors_meta_box';
$args['metabox_context']			= 	'normal';
$args['metabox_priority']			= 	'high';
$metabox = new KTT_new_metabox($args);



/**
* Metabox render
*/
function KTT_post_coauthors_meta_box($post) {

    /**
  	* Invocamos la libreria selectd que nos ayuda a crear multiselects
  	*/
  	wp_enqueue_style('style-select2', KTT_path_to_url(KOHETTE_FW_RESOURCES . '/select2/select2.css'));
    wp_enqueue_script( 'select2', KTT_path_to_url(KOHETTE_FW_RESOURCES . '/select2/select2.js') );

    /**
    * Obtenemos el array de authores
    */
    $post_coauthors = KTT_get_post_coauthors($post);
    $post_coauthors = wp_list_pluck($post_coauthors, 'ID');

    /**
    * Obtenemos la lista completa de todos los users del site-wrap
    */
    $users = get_users(array('exclude' => $post->post_author));

    ?>
      <p>
        <?php _e('Here you can add users as co-authors of the post.', THEME_TEXTDOMAIN);?>
      </p>

      <select
      style="width:100%"
      name="<?php echo ktt_var_name('post_coauthors');?>[]"
      multiple="multiple">
        <?php foreach ($users as $user) {?>
          <option <?php if (in_array($user->ID, $post_coauthors)) {?>selected<?php } ?> value="<?php echo $user->ID;?>"><?php echo $user->display_name ;?> (<?php echo $user->user_login;?>) </option>
        <?php } ?>
      </select>

      <script>jQuery(document).ready(function() { jQuery("select[multiple=multiple]").select2();});</script>
    <?php

}


/**
* Esta funcion se encarda de devolver un array con todos los authores de un post
*/
function KTT_get_post_coauthors($post) {

    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    /**
    * Definimos la varaible que va a contener el array resultante
    */
    $result = array();

    /**
    * Si ya hay posts auhtors definidos los Obtenemos
    */
    if (isset($post->post_coauthors) && $post->post_coauthors) $result = $post->post_coauthors;

    /**
    * Si el author del post aparece como coauthor debemos quitarlo de la lista
    */
    if ($result) if (in_array($post->post_author, $result)) unset($result[$post->post_author]);

    /**
    * Si no tenemos coauthores salimos de aqui
    */
    if (!$result) return array();

    /**
    * Devolvemos los objeto users completos
    */
    $result = get_users(array('include' => $result));

    /**
    * Devolvemos el resultado
    */
    return $result;

}


/**
* Esta funcion se encarga de devolver en un mismo array el author y los coauthores de un post
*/
function KTT_get_post_author_and_coauthors($post) {

    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    /**
    * Obtenemos el auhotr del post
    */
    $author = get_users(array('include' => $post->post_author));

    /**
    * Obtenemos los coauthores
    */
    $coauthors = KTT_get_post_coauthors($post);

    /**
    * Si no hay coauthores devolvemos directamente el author
    */
    if (!$coauthors) return $author;

    /**
    * Juntamos el auhotr con los coauthores
    */
    $result = array_merge($author, $coauthors);

    /**
    * Devolvemos el array resultante
    */
    return $result;

}





/**
* Incluimos el script que se encarga de mostrar las columnas
*/
require_once('post-co-authors-columns.php');

/**
* El filtros
*/
require_once('post-custom-query-args-coauthors.php');




?>
