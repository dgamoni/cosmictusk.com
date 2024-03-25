<?php
/**
* Aqui aglutinaremos las funciones relacionadas con los sideheaders del sitio
* los sideheaders son los sustitutos del header que se muestran a la izquieda de pagians del theme
*/





/**
* Esta funcion determina que sideheader debe mostrarse en la pagina actual
*/
function KTT_display_sideheader($object = '') {


  $featured_image_id = '';
  if (is_category() || is_tag()) $featured_image_id = KTT_get_category_featured_image_id(get_queried_object()->term_id);
  elseif (is_author()) $featured_image_id = KTT_get_user_featured_image_id();
  //elseif (is_home() || is_front_page()) $featured_image_id = KTT_get_featured_image_from_current_posts();
  elseif (is_home() || is_front_page()) $featured_image_id = KTT_get_featured_image_from_current_posts_onlyhome();
  elseif (is_page() || is_single()) $featured_image_id = get_post_thumbnail_id();
  elseif (is_archive() || is_search()) $featured_image_id = KTT_get_featured_image_from_current_posts();

  /**
  * Vamos a formar el array de arguemntos que le pasaremos a la funcion que se encarga
  * realmente de mostrar el div
  */
  $args = array(
        "card_id" => "post-header",
        "card_classes" => "backdrop  text-align-center basic-sideheader backdrop-gradient-1 site-palette-yang-1-color",

        /**
        * Obtenemos los datos de la imagen header
        */
        "card_background_attachment" => $featured_image_id,

        /**
        * Llamamos ala funcion que se encarga de crear el contenido del site header
        * pasamos solo el nombre de la fucnion porque este parametro actua como un callback
        */
        "card_content" => "KTT_cover_comodin",

        /**
        * alineacion
        */
        "card_align" => "space-between center",

  );

  /**
  * Ejecutamos la funcion que realmente se encarga de mostrar el header
  */
  KTT_display_image_card($args);

}



/**
* Esta es la funcion que se encarga de formar el cover que debe ir en la partes
* superior de cada pagina en el theme
*/
function KTT_cover_comodin() {

    /**
    * Obtenemos el objeto que se esta requiriendo
    */
    $object = get_queried_object();

    /**
    * En primer lugar vamos a crear un array que contendrá mas adelante
    * toda la informacion que deberemos mostrar en el cover, dependiendo
    * del tipo de página en el que estemos será una información u otra.
    */
    $info = array(
      'title' => '',
      'title_size' => 'typo-size-xlarge',
      'description' => '',
      'description_size' => 'typo-size-small',
      'background_image' => '',
    );


    /**
    * Si estamos con una categoria....
    */
    if (is_category() || is_tag()) {

          $info = array(
            'title' => $object->name,
            'title_size' => 'typo-size-xxlarge',
            'description' => $object->description,
            'description_size' => 'typo-size-small',
          );

    } elseif (is_author()) {

          if ( $author_id = get_query_var( 'author' ) ) { $user = KTT_get_user_by( 'id', $author_id ); }

          $info = array(
            'title' => $user->display_name,
            'title_size' => 'typo-size-xxlarge',
            'description' => $user->user_description,
            'description_size' => 'typo-size-small',
          );

    } elseif (is_archive()) {

          $info = array(
            'title' => get_the_archive_title(),
            'title_size' => 'typo-size-xxlarge',
            'description' => get_the_archive_description(),
            'description_size' => 'typo-size-small',
          );

    } elseif (is_search()) {

          global $wp_query;

          $info = array(
            'title' => '',
            'title_size' => 'typo-size-large',
            'description' => '',
            'description_size' => 'typo-size-small',
          );

    } else if (is_page() || is_single()) {

          $info = array(
            'title' => get_the_title(),
            'title_size' => 'typo-size-xxlarge',
            'description' => '',
            'description_size' => 'typo-size-small',
          );

    } elseif (is_home() || is_frontpage()) {

          $info = array(
            'title' => get_bloginfo('title'),
            'title_size' => 'typo-size-xxxlarge',
            'description' => get_bloginfo('description'),
            'description_size' => 'typo-size-small',
          );

    }


    ?>

    <div class="padding-both-50 padding-top-50">
      <div class="padding-both-30 padding-top-30">

      </div>
    </div>


    <div class="max-width-600px width-100">


        <div class="site-palette-yang-1-color display-block padding-both-20">

            <?php if (is_author()) {?>
            <div class="padding-bottom-20 padding-top-40">
              <?php echo get_avatar( $user->ID, '150', '', $user->display_name, array( 'class' => array( 'border-radius-100', 'md-whiteframe-3dp' ) ) );; ;?>
            </div>
            <?php } ?>

            <div class=" <?php echo $info['title_size'];?> text-shadow-1 site-typeface-title padding-left-10 padding-right-10 typo-size-subtitle ">
              <?php echo $info['title'];?>
            </div>

            <?php if ($info['description_size']) {?>
            <div class="<?php echo $info['description_size'];;?> padding-top-20 site-typeface-headline opacity-05 padding-left-10 padding-right-10 ">
              <?php echo $info['description'];;?>
            </div>
            <?php } ?>

            <?php if (is_search()) {?>
            <style>
              .search-form input {
                border-style:solid;
                border-width:2px;
                border-radius:3px;
                padding:15px;
                font-size:23;
                font-weight:300;
                display:none;
                box-sizing: border-box;
              }

              .search-form input[type="search"] {
                width:100%;
                display:block;
                margin-top:10px;
              }
            </style>
            <div class="width-100 search-form">
              <?php get_search_form();?>
            </div>
            <?php } ?>

        </div>

        <div flex class="post-item-meta padding-left-30 padding-right-30" >
          <hr class="opacity-02">
        </div>

        <?php if (is_author()) {?>
        <div
        layout-wrap
        layout="row"
        layout-align="space-around center"
        class="author-contact typo-size-xsmall classic-link-inside padding-top-5 text-align-center padding-bottom-50">

      			<?php
      			if ($user->user_url) {?>
      			<a href="<?php echo $user->user_url;?>" target="_blank" class="padding-both-5 icon-globe c-method">
      				<?php echo $user->user_url;?>
      			</a>
      			<?php } ?>

      			<?php
      			if ($user->user_twitter) {?>
      			<a href="https://twitter.com/<?php echo $user->user_twitter;?>" target="_blank" class="padding-both-5 icon-twitter c-method">
      				@<?php echo $user->user_twitter;?>
      			</a>
      			<?php } ?>

      			<?php
      			if ($user->user_facebook) {?>
      			<a href="https://facebook.com/<?php echo $user->user_facebook;?>" target="_blank" class="padding-both-5 icon-facebook c-method">
      				Facebook
      			</a>
      			<?php } ?>

            <?php
      			if ($user->user_instagram) {?>
      			<a href="https://instagram.com/<?php echo $user->user_instagram;?>" target="_blank" class="padding-both-5 icon-instagram c-method">
      				Instagram
      			</a>
      			<?php } ?>

    		</div>
        <?php } ?>




    </div>


    <div class="padding-bottom-50">
      <div class="padding-both-30 padding-top-30">

      </div>
    </div>
    <?php




}



?>
