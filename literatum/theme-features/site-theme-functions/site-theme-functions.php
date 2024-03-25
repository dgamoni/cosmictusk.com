<?php
/**
* En este archivo almacenaremos todas las funcionones exclusivas del theme
version: 1.0.1
*/




/**
* Obtiene la template de la frontpage
*/
function KTT_get_frontpage_posts_template() {

      /**
      * Obtenemos la id de la template
      */
      $template_id = get_option(ktt_var_name('frontpage_posts_template'));

      /**
      * Obtenemos la template
      */
      $template = KTT_get_theme_template($template_id);

      /**
      * Devolvemos la template
      */
      return $template;

}



/**
* Esta funcion se encarga de obtener los links de next y previous de una página
*/
function KTT_get_next_previous_links() {


    /**
    * Formamos el array result
    */
    $result = array(
      'previous' => array(
        'title' => '',
        'url' => '',
        'label' => __('Previous', THEME_TEXTDOMAIN),
      ),
      'next' => array(
        'title' => '',
        'url' => '',
        'label' => __('Next', THEME_TEXTDOMAIN),
      ),
    );


    /**
    * Si estamos en una pagina single tenemos que obtener los links de
    * siguiente y previo post
    */
    if (is_single()) {

          /**
          * Default
          */
          $result['previous']['label']  = __('Next', THEME_TEXTDOMAIN);
          $result['next']['label']  = __('Previous', THEME_TEXTDOMAIN);

          $next = get_previous_post();
          $prev = get_next_post();

          /**
          * Formamos el array con los datos del link previous
          */
          if ($next) {
            $result['previous']['title']  = $next->post_title;
            $result['previous']['url']    = get_permalink($next);
            $result['previous']['label']  = __('Next', THEME_TEXTDOMAIN);
          }

          /**
          * Formamos el array con los datos del link next
          */
          if ($prev) {
            $result['next']['title']  = $prev->post_title;
            $result['next']['url']    = get_permalink($prev);
            $result['next']['label']  = __('Previous', THEME_TEXTDOMAIN);
          }


    /**
    * Por defecto intentamos obtener los links de siguiente y anterior de la query
    * que estemos usando
    */
    } else {

          /**
          * Default
          */
          $result['previous']['label']  = __('Next page', THEME_TEXTDOMAIN);
          $result['next']['label']  = __('Previous page', THEME_TEXTDOMAIN);

          $next = get_previous_posts_link();
          $prev = get_next_posts_link();

          /**
          * Formamos el array con los datos del link previous
          */
          if ($prev) {
            $result['previous']['title']  = __('Next page', THEME_TEXTDOMAIN);
            $result['previous']['url']    = get_next_posts_page_link();
            $result['previous']['label']  = __('Next page', THEME_TEXTDOMAIN);
          }

          /**
          * Formamos el array con los datos del link next
          */
          if ($next) {
            $result['next']['title']  = __('Previous page', THEME_TEXTDOMAIN);
            $result['next']['url']    = get_previous_posts_page_link();
            $result['next']['label']  = __('Previous page', THEME_TEXTDOMAIN);
          }

    }


    /**
    * Devolvemos el array como resultado de la function
    */
    return $result;

}




/**
* Esta funcion obtiene la id delo logo del sitio
*/
function KTT_get_site_logo_id() {
  return get_theme_mod( 'custom_logo' );
}

/**
* Esta funcion se encarga de obtener la url del logo en le tamaño que le pasaremos
*/
function KTT_get_site_logo_url($size = 'medium') {

  /**
  * En primer lugar obtenemos la id del logo
  */
  $logo_id = KTT_get_site_logo_id();

  /**
  * Si no hay id salimos de aqui
  */
  if (!$logo_id) return;

  /**
  * Devolvemos la url al tamaño que nos han pedido
  */
  return KTT_scaled_image_url($logo_id, $size);

}

/**
* esta funcion se encarga de obtener el logo del sitio si lo tuviere
*/
function KTT_get_site_logo_attachment() {

      /**
      * En primer lugar intentamos obtener el id del attachment de la imagen que actua como logo
      * en nuestro sitio
      */
      $logo_id = get_theme_mod( 'custom_logo' );

      /**
      * Si no tenemos logo salimos de aqui
      */
      if (!$logo_id) return;

      /**
      * Obtenemos el attachment
      */
      $result = KTT_get_post($logo_id);

      /**
      * Devolvemos el resultado
      */
      return $result;

}





function KTT_get_archive_template() {


    /**
    * Si no hemos obtenido una id de template entonces vamos a comprobar si el theme tiene definida
    * una por defecto para las categorias que no la tengan
    */
    $template_id = '';
    if (!$template_id) $template_id = get_option(ktt_var_name('archive_template'));

    /**
    * Si a estas alturas seguimos sin template id vamos a obtener la lista compelta y nos quedamos
    * con la primera
    */
    if (!$template_id) {

        /**
        * lista de templates
        */
        $templates = KTT_get_theme_templates_by_type('archive');

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



function KTT_get_search_template() {


    /**
    * Si no hemos obtenido una id de template entonces vamos a comprobar si el theme tiene definida
    * una por defecto para las categorias que no la tengan
    */
    $template_id = '';
    if (!$template_id) $template_id = get_option(ktt_var_name('search_template'));

    /**
    * Si a estas alturas seguimos sin template id vamos a obtener la lista compelta y nos quedamos
    * con la primera
    */
    if (!$template_id) {

        /**
        * lista de templates
        */
        $templates = KTT_get_theme_templates_by_type('search');

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



/**
* Esta funcion se encarga de obtener los posts que estamos mostrando en la pagina
* actual y obtenemos una imagen de uno de los posts al azar
*/
function KTT_get_featured_image_from_current_posts() {

      /**
      * Si hemos llegado hasta aqui significa que la categoria no tiene imagen definida, por lo tanto
      * vamos a obtener los ultimos 10-15 posts pertenecientes a la categoria y a extraer
      * la imagen destacada de alguno de sus posts para utilizarla como imagen de la categoria
      */
      //$args = array('post_type' => 'post', 'post_status' => 'publish', 'cat' => $category_id, 'posts_per_page' => 15);
      //$q = new WP_Query($args);
      //$posts = $q->posts;
      global $wp_query;

      // RANDOM!
      $posts = '';
      if ($wp_query->posts) {
        $posts = $wp_query->posts;
        shuffle($posts);
      }

      /**
      * Itineramos por cada post y extraemos la primera featured image que encontremos
      */
      if ($posts) foreach ($posts as $post) {
          $attach_id = get_post_thumbnail_id($post->ID);
          if ($attach_id) return $attach_id;
      }

      return false;

}


function KTT_get_featured_image_from_current_posts_onlyhome() {

      /**
      * Si hemos llegado hasta aqui significa que la categoria no tiene imagen definida, por lo tanto
      * vamos a obtener los ultimos 10-15 posts pertenecientes a la categoria y a extraer
      * la imagen destacada de alguno de sus posts para utilizarla como imagen de la categoria
      */
      //$args = array('post_type' => 'post', 'post_status' => 'publish', 'cat' => $category_id, 'posts_per_page' => 15);
      //$q = new WP_Query($args);
      //$posts = $q->posts;
      global $wp_query;

      // RANDOM!
      $posts = '';
      if ($wp_query->posts) {
        $posts = $wp_query->posts;
        //shuffle($posts);
      }


      /**
      * Itineramos por cada post y extraemos la primera featured image que encontremos
      */
      $arr_att = array();

      if ($posts) foreach ($posts[0] as $post) {
          $attach_id = get_post_thumbnail_id($post->ID);
          $out = '9485';
          $arr_att[0] = '9485';
          $arr_att[1] = $attach_id;
          shuffle($arr_att);
          //if ($attach_id) return $attach_id;
          return $arr_att[0];
      }

      return false;

}

/**
* Esta funcion se encarga de devolver el attachment id de la imagen que tengamos
* puesta como imagen de header del sitio
*/
function KTT_get_header_image_attachment_id() {
    $header = get_custom_header();
    if ($header && isset($header->attachment_id)) return $header->attachment_id;
}



/**
* Esta funcion ose encarga de mostrar un div de imagen
* esta es una funcion muy socorrida utilizada por elementos que deben mostrar una imagen
**/
function KTT_display_image_card($args = '') {

      /**
      * Definimos un array con los valores por defecto que tiene
      * el parametro args de la function
      */
      $defaults = array(

          /**
          * Esto define la id que le podemos dar al elemento
          */
          "card_id" => "card-" . rand(100, 99999),

          /**
          * Podemos definir tambien un string con clases particulares que queramos darle
          * a nuestra card
          */
          "card_classes" => "",

          /**
          * Define el contenido que se pondrá dentro del elemento
          */
          "card_content" => "",

          /**
          * Si queremos que la card enlace con alguna url lo podemos indicar aqui
          */
          "card_href" => "",

          /**
          * Mostramos video si lo tiene?
          */
          "card_video" => false,

          /**
          * La alineacion del contenido
          */
          "card_align" => "space-between stretch",

          /**
          * El background attachment debe ser la id de la imagen que usaremos como fondo para
          * el div.
          */
          "card_background_attachment" => 0,

          /**
          * En lugar de attachment tambien podemos indicar directamente la imagen que queremos
          * cargar
          */
          "card_image_medium" => "",
          "card_image_large" => "",

      );

      /**
      * A parsear arguemntos!
      */
      $args = wp_parse_args( $args, $defaults);




      /**
      * Vamos a definir que tipo de elemento debemos aplicar, si no se ha indicado un href
      * utilizaremos un div, en caso contrario debemos convertir la card en un enlace
      */
      $elem_type = 'div';
      if ($args['card_href']) $elem_type = 'a';


      /**
      * Antes de pasar a formar el html aplicamos un filter sobre los parametros de la funcion
      * esto nos permite editarlos desde terceras funciones
      */
      $args = apply_filters("KTT_theme_display_image_card_args", $args);


      /**
      * Si se ha indicado un attachment vamos a extraer la imagen en diferentes tamaños
      */
      if ($args['card_background_attachment']) {

          /**
          * Tomamos una version reducida de la imagen, esta es la imagen que vamos a cargar
          * en primer lugar
          */
          if (!$args['card_image_medium']) $args['card_image_medium'] = KTT_scaled_image_url($args['card_background_attachment'], 'medium');

          /**
          * Tomamos la version real de la imagen, Generalmente esta imagen tiene mas peso por lo
          * que la intentaremos cargar dinamicamente en segundo plano y mientras mostraremos
          * la version medium de la imagen
          */
          if (!$args['card_image_large']) $args['card_image_large'] = KTT_scaled_image_url($args['card_background_attachment'], 'large');

          /**
          * Si tenemos attachment definido entonces vamos a añadir la clase "ktt-backgroundy"
          * a la lista de clases. Esta clase hace que el fondo se cargue debidamente
          */
          $args['card_classes'] .= " ktt-backgroundy";

      }

      ?>




        <div
        id="<?php echo $args['card_id'];?>"
        data-background-thumb="<?php echo $args['card_image_medium'];?>"
        data-background-large="<?php echo $args['card_image_large'];?>"
        class="site-palette-yin-1-background-color basic-sideheader"
        layout="column"
        style="overflow:hidden"

        >

            <?php
            /**
            * Display featured video
            */
            if ($args["card_video"] && is_header_video_active() && get_header_video_url()) { ?>
                <?php the_custom_header_markup();?>
            <?php }?>


            <<?php echo $elem_type;?>
            <?php if ($args['card_href']) {?>href="<?php echo $args['card_href'];?>"<?php } ?>
            style="position:relative;z-index:10"
            layout-align="<?php echo $args['card_align'];?>"
            layout="column"
            class="card-content site-palette-yang-1-color <?php echo $args['card_classes'];?> <?php echo $args['card_id'];?>-content"
            >

                <?php if ($args["card_content"]) {
                    if (is_array($args["card_content"])) {
                      echo call_user_func($args["card_content"][0], $args["card_content"][1]);
                    } else {
                      echo call_user_func($args["card_content"]);
                    }
                }?>

            </<?php echo $elem_type;?>>

        </div>


        <script>
        jQuery( document ).ready(function() {
            jQuery( "#<?php echo $args['card_id'];?>" ).ktt_backgroundy();
        });
        </script>

  <?php
}
