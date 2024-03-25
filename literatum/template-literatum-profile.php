<?php
/*
Template Name: Author Profile
Template Post Type:  user
Template Styles: template-grid
*/


if(isset($config_mode) && $config_mode){

    return;
}



/**
* Empieza la template
*/
global $wp_query;
get_header();

?>



<div flex id="site-body"   class="template-masonry-default site-palette-yang-1-background-color site-palette-yin-2-color">


  <?php
  if ( $author_id = get_query_var( 'author' ) ) { $user = KTT_get_user_by( 'id', $author_id ); }

  $info = array(
    'title' => $user->display_name,
    'title_size' => 'typo-size-xxlarge',
    'description' => $user->user_description,
    'description_size' => 'typo-size-small',
  );


  if (is_author()) $featured_image_id = KTT_get_user_featured_image_id();


  /**
  * Vamos a formar el array de arguemntos que le pasaremos a la funcion que se encarga
  * realmente de mostrar el div
  */
  $args = array(
        "card_id" => "post-header",
        "card_classes" => "backdrop height-400px  text-align-center backdrop-gradient-1 site-palette-yang-1-color",

        /**
        * Obtenemos los datos de la imagen header
        */
        "card_background_attachment" => $featured_image_id,

        /**
        * Llamamos ala funcion que se encarga de crear el contenido del site header
        * pasamos solo el nombre de la fucnion porque este parametro actua como un callback
        */
        "card_content" => "",

        /**
        * alineacion
        */
        "card_align" => "space-between center",

  );

  /**
  * Ejecutamos la funcion que realmente se encarga de mostrar el header
  */
  KTT_display_image_card($args);





   ?>

  <div class="max-width-600px text-align-center  width-100 margin-auto">


      <div
      style="margin-top:-100px;position:relative;z-index:222;"
      class="site-palette-yin-2-color display-block padding-both-20">

          <?php if (is_author()) {?>
          <div class="padding-bottom-20" >
            <?php echo get_avatar( $user->ID, '150', '', $user->display_name, array( 'class' => array( 'border-radius-100', 'md-whiteframe-3dp' ) ) );; ;?>
          </div>
          <?php } ?>

          <div class=" <?php echo $info['title_size'];?> site-typeface-title padding-left-10 padding-right-10 typo-size-subtitle ">
            <?php echo $info['title'];?>
          </div>

          <?php if ($info['description_size']) {?>
          <div class="<?php echo $info['description_size'];;?> padding-top-20 site-typeface-headline  padding-left-10 padding-right-10 ">
            <?php echo $info['description'];;?>
          </div>
          <?php } ?>

      </div>



      <?php if (is_author()) {?>
      <div
      layout-wrap
      layout="row"
      layout-align="space-around center"
      class="author-contact typo-size-xsmall classic-link-inside padding-top-5 text-align-center padding-bottom-50">

          <?php
          if ($user->user_url) {?>
          <a href="<?php echo $user->user_url;?>" target="_blank" class="padding-both-5 icon-globe site-palette-special-1-color c-method">
            <?php echo $user->user_url;?>
          </a>
          <?php } ?>

          <?php
          if ($user->user_twitter) {?>
          <a href="https://twitter.com/<?php echo $user->user_twitter;?>" target="_blank" class="padding-both-5 site-palette-special-1-color icon-twitter c-method">
            @<?php echo $user->user_twitter;?>
          </a>
          <?php } ?>

          <?php
          if ($user->user_facebook) {?>
          <a href="https://facebook.com/<?php echo $user->user_facebook;?>" target="_blank" class="padding-both-5 site-palette-special-1-color icon-facebook c-method">
            Facebook
          </a>
          <?php } ?>

          <?php
          if ($user->user_instagram) {?>
          <a href="https://instagram.com/<?php echo $user->user_instagram;?>" target="_blank" class="padding-both-5 site-palette-special-1-color icon-instagram c-method">
            Instagram
          </a>
          <?php } ?>

      </div>
      <?php } ?>

      <div flex class="post-item-meta padding-left-10 padding-right-10" >
        <hr class="opacity-02">
      </div>




  </div>





      <?php if (!$wp_query->posts) {?>
          <div flex class="padding-both-50">
            <div class="typo-size-xxxlarge icon-emo-unhappy"></div>
            <div class="typo-size-medium padding-top-20 typo-weight-300"><?php _e('Sorry, no results found.', THEME_TEXTDOMAIN);?></div>
          </div>
      <?php } ?>



      <?php if (have_posts()) : ?>
        <div class="padding-top-10"></div>
        <div
        id="posts-list"
        layout="column"
        class="text-align-left max-width-700px margin-auto padding-both-40">
          <?php while (have_posts()) : the_post(); ?>

                <div
                style="vertical-align:top;"
                class=" site-palette-yang-4-border-color padding-both-20 ">

                    <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="classic-link display-block site-palette-yin-1-color padding-bottom-5 site-typeface-title typo-size-large post-title">
                      <?php echo strip_tags(KTT_get_the_title(), '<strong><b><i><em><u>');?>
                    </a>

                    <?php //if ($post->post_subtitle) {?>
                    <h2 class="typo-weight-300 site-palette-yin-3-color padding-top-5 padding-bottom-0 site-typeface-headline typo-size-small ">
                      <?php echo strip_tags(KTT_get_the_subtitle(), '<strong><b><i><em><u>');?>
                    </h2>
                    <?php //} ?>

                    <div class="typo-size-xsmall site-palette-yin-2-color"><?php the_excerpt();?></div>



                    <div
                    class="padding-top-10 typo-size-xsmall"
                    layout-align="space-between center"
                    layout="row"
                    >

                        <div>
                          <span>
                            <?php
                            /**
                            * Obtenemos la lista de authores
                            */
                            $authors = KTT_get_post_author_and_coauthors($post);

                            /**
                            * Itineramos por cada uno de ellos
                            */
                            if ($authors) foreach($authors as $author) {?>

                                <strong class="by-user">
                                  <a
                                  class="classic-link site-palette-yin-1-color "
                                  href="<?php echo get_author_posts_url($author->ID);?>"><?php echo $author->display_name;?>
                                  </a>
                                </strong>

                            <?php } ?>
                          </span>

                          <span class="margin-left-5  ornament-point-before">
                            <?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', THEME_TEXTDOMAIN ), number_format_i18n( get_comments_number() ) );?>
                          </span>

                          <?php if (function_exists('KTT_post_display_read_time_is_active') && KTT_post_display_read_time_is_active()) { ?>
                          <span class="margin-left-5  ornament-point-before">
                            <?php echo sprintf(__('%s min read', THEME_TEXTDOMAIN), KTT_display_post_read_time());?>
                          </span>
                          <?php } ?>

                          <span class="margin-left-5  ornament-point-before">
                            <a class="classic-link site-palette-special-1-color" title="<?php the_title();?>" href="<?php the_permalink();?>"><?php _e('Continue reading', THEME_TEXTDOMAIN);?></a>
                          </span>

                        </div>



                    </div>




                    <div class="padding-top-50"></div>
                    <hr class="display-block site-palette-yang-3-border-color">
                    <div class="padding-bottom-10"></div>

                </div>


  				    <?php endwhile; ?>
        </div>
      <?php endif; ?>



      <?php
      /**
      * Obtenemos los links de anterior y siguiente
      */
      $pagination_links = KTT_get_next_previous_links();


      ?>

      <p class="site-typeface-body  typo-size-xsmall text-align-center padding-both-50  padding-top-10 max-width-700px margin-auto" layout="row">


          <span flex>

            <?php if ($pagination_links['next']['url']) {?>
              <a
              class="site-palette-yin-3-color margin-left-5 display-block border-style-solid  md-whiteframe-2dp border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 button-behaviour padding-bottom-10 "
              title="<?php echo $pagination_links['next']['title'];?>"
              href="<?php echo $pagination_links['next']['url'];?>">
                <span class="icon-left-hand"></span> <span hide-xs><?php echo $pagination_links['next']['label'];?></span>
              </a>
            <?php } else {?>
              <span class="margin-left-5 display-block border-style-solid opacity-03 border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 padding-bottom-10"><span class="icon-left-hand"></span> <span hide-xs><?php echo $pagination_links['next']['label'];?></span></span>
            <?php } ?>

          </span>

          <span
          flex="30"
          flex-sm="20"
          class="padding-both-10 <?php if (!$pagination_links['next']['url'] && !$pagination_links['previous']['url']) {?> opacity-03 <?php }?> "
          layout="row"
          layout-align="space-around center"
          hide-xs>
            <em class="icon-dot"></em>
            <em class="icon-dot"></em>
            <em class="typo-size-medium icon-book-open"></em>
            <em class="icon-dot"></em>
            <em class="icon-dot"></em>
          </span>

          <span flex>

            <?php if ($pagination_links['previous']['url']) {?>
              <a class="site-palette-yin-3-color margin-right-5 display-block border-style-solid  md-whiteframe-2dp border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 button-behaviour padding-bottom-10 " title="<?php echo $pagination_links['previous']['title'];?>" href="<?php echo $pagination_links['previous']['url'];?>">
                <span hide-xs><?php echo $pagination_links['previous']['label'];?></span> <span class="icon-right-hand"></span>
              </a>
            <?php }else {?>
              <span class="margin-right-5 opacity-03 display-block border-style-solid border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 padding-bottom-10 "><span hide-xs><?php echo $pagination_links['previous']['label'];?></span> <span class="icon-right-hand"></span></span>
            <?php } ?>

          </span>



      </p>

      <div class="padding-both-50"></div>



</div>


<?php
get_footer();
