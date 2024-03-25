<?php
/**
* En este archivo almacenaremos todas las funcionones exclusivas del theme
*/


/**
* Esta funcion genera el contenido del cover del post
*/
function KTT_post_cover($post = '') {
  global $template;
  if (!$post) global $post;

  ?>


  <div class="padding-both-40">
    <div class="padding-both-40">
    </div>
  </div>

  <div class="padding-both-40" >
  <div class=" max-width-700px typography-responsive" >



      <div
      layout="row"
      layout-xs="column"
      layout-align="space-between center"
      layout-align-xs="center center"
      flex
      class="opacity-05 site-typeface-body typo-size-xsmall post-item-meta  padding-top-5 padding-bottom-10 " >

              <?php if (
                isset($template->options['displays'])
                && isset($template->options['displays']['post_categories'])
                && $template->options['displays']['post_categories']
              )  {?>
                <span flex="auto" class="hide-xs text-align-left padding-right-20 classic-link-inside   margin-auto">
                  <i hide-xs class="material-icons">folder</i> <span class="opacity-05"><?php _e('Filed in', THEME_TEXTDOMAIN);?></span> <span class="site-palette-yang-3-color link-white-color"> <?php the_category(', '); ?></span>
                </span>
              <?php } ?>

              <?php if (
                isset($template->options['displays'])
                && isset($template->options['displays']['post_share_buttons'])
                && $template->options['displays']['post_share_buttons']
              )  {?>
                <span flex="auto" class="text-align-right margin-auto">
                <?php
								// share params

								$url 		=  	$post->share['url'];
								$text 		= 	$post->share['text'];
								$via 		= 	$post->share['twitter']['via'];
								$related 	= 	$post->share['twitter']['related'];
								$hashtags 	= 	$post->share['twitter']['hashtags'];

								if ($via) $via = '&amp;via=' . $via;
								if ($related) $related = '&amp;related=' . $related;

								?>

								<script>
									var lefts = (screen.width/2)-(450/2);
	        				var tops = (screen.height/2)-(350/2);
	        			</script>


	        			<?php //if (isset($general_option_share_links['twitter']) && $general_option_share_links['twitter']) {?>
								<span class="hide-xs cursor-pointer share-item  ornament-or-before-amper" onclick="window.open('https://twitter.com/share?url=<?php echo $url; ?>&amp;text=<?php echo $text;?><?php echo $via;?><?php echo $related;?>&amp;hashtags=<?php echo $hashtags;?>','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=450,height=350, top='+ tops +', left='+ lefts)">
									<span class="icon-twitter hide-on-mobile classic-link "><?php _e('Tweet',THEME_TEXTDOMAIN);?></span>
								</span>
								<?php //} ?>


	        			<?php //if (isset($general_option_share_links['facebook']) && $general_option_share_links['facebook']) {?>
								<span class="hide-xs cursor-pointer share-item margin-left-5  ornament-or-before-amper" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=450,height=350, top='+ tops +', left='+ lefts)">
									<span class="icon-facebook hide-on-mobile classic-link "><?php _e('Share',THEME_TEXTDOMAIN);?></span>
								</span>
								<?php //} ?>


	        			<?php //if (isset($general_option_share_links['read_later']) && $general_option_share_links['read_later']) {?>
								<span class="hide-xs cursor-pointer share-item margin-left-5  ornament-or-before-amper" onclick="window.open('https://getpocket.com/edit?url=<?php echo $url;?>&amp;title=<?php echo $text;?>','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=450,height=350, top='+ tops +', left='+ lefts)">
									<span class="icon-list-add hide-on-mobile classic-link "><?php _e('Read later',THEME_TEXTDOMAIN);?> </span>
								</span>
								<?php //} ?>


              </span>
              <?php } ?>



      </div>


      <a href="<?php echo get_permalink($post->ID);?>" class="site-palette-yang-1-color display-block padding-top-20 padding-bottom-20">
          <div class="text-shadow-1 typo-size-xxxxlarge site-typeface-title padding-bottom-20">
            <?php echo KTT_get_post_title_formated($post);?>
          </div>
          <div class="site-typeface-headline font-weight-300 opacity-05 typo-size-large">
            <?php echo KTT_get_post_subtitle_formated($post);?>
          </div>
      </a>


      <div flex class="site-typeface-body typo-size-small post-item-meta  padding-top-5 padding-bottom-10 " >

              <?php if (
                isset($template->options['displays'])
                && isset($template->options['displays']['post_author'])
                && $template->options['displays']['post_author']
              )  {?>
              <span class="ornament-point-before-amper">
                <?php
                /**
                * Obtenemos la lista de authores
                */
                $authors = KTT_get_post_author_and_coauthors($post);

                /**
                * Itineramos por cada uno de ellos
                */
                if ($authors) foreach($authors as $author) {?>

                    <strong class="by-user"><a class="classic-link site-palette-yang-1-color" href="<?php echo get_author_posts_url($author->ID);?>"><?php echo $author->display_name;?></a></strong>

                <?php } ?>
              </span>
              <?php } ?>

              <?php if (
                isset($template->options['displays'])
                && isset($template->options['displays']['post_date'])
                && $template->options['displays']['post_date']
              )  {?>
              <span class=" margin-left-5  ornament-point-before-amper" >
                <i class="material-icons">event</i> <span class=""> <?php echo get_the_date();?></span>
              </span>
              <?php } ?>

              <?php if (
                isset($template->options['displays'])
                && isset($template->options['displays']['post_comments_count'])
                && $template->options['displays']['post_comments_count']
              )  {?>
              <span class=" margin-left-5  ornament-point-before-amper" data-disqus-url="<?php echo get_permalink();?>">
                <i class="material-icons">comment</i> <span class="disqus-comment-count"> <?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', THEME_TEXTDOMAIN ), number_format_i18n( get_comments_number() ) );?></span>
              </span>
              <?php } ?>

              <?php if (
                isset($template->options['displays'])
                && isset($template->options['displays']['post_read_time'])
                && $template->options['displays']['post_read_time']
              )  {?>
              <?php if (function_exists('KTT_post_display_read_time_is_active') && KTT_post_display_read_time_is_active()) { ?>
              <span class="margin-left-5  ornament-point-before-amper">
                <i class="material-icons">access_time</i> <?php echo sprintf(__('%s min read', THEME_TEXTDOMAIN), KTT_display_post_read_time());?>
              </span>
              <?php } ?>
              <?php } ?>

      </div>


  </div>
  </div>




  <div class="padding-both-20">
    <div class="padding-both-40">
    </div>

    <?php if (is_single()) {?>
      <div class="padding-bottom-50">
        <span class="typo-size-xlarge icon-down-open-big font-weight-700"></span>
      </div>
    <?php } ?>

      <?php if ($post->post_credits) {?>
      <div class="classic-link-inside typo-size-xsmall text-align-right opacity-05"><?php echo $post->post_credits;?></div>
      <?php } ?>
  </div>


  <?php


}





/**
* Esta funcion genera el contenido del cover del post
*/
function KTT_post_item_list_cover() {
  global $post, $template;

  ?>


  <div class="padding-both-5"></div>

  <div class=" padding-top-10 padding-bottom-10">
  <div class=" max-width-700px typography-responsive" >



      <div
      layout="row"
      layout-xs="column"
      layout-align="space-between start"
      flex
      class="opacity-05 site-typeface-body typo-size-xsmall post-item-meta  padding-top-5 padding-bottom-10 " >
      </div>


      <a href="<?php echo get_permalink($post->ID);?>" class="site-palette-yang-1-color display-block padding-top-20 padding-bottom-5">
          <div class="text-shadow-1 typo-size-large site-typeface-title padding-bottom-5">
            <?php echo KTT_get_post_title_formated($post)?>
          </div>
          <?php if ($post->post_subtitle_formated) {?>
          <div class="site-typeface-headline font-weight-300 opacity-05 padding-top-10 padding-bottom-5 typo-size-small">
            <?php echo KTT_get_post_subtitle_formated($post);?>
          </div>
          <?php } ?>
      </a>

      <span class="site-typeface-body typo-size-xsmall post-item-meta  padding-top-5 padding-bottom-5 padding-bottom-10">
        <?php
        /**
        * Obtenemos la lista de authores
        */
        $authors = KTT_get_post_author_and_coauthors($post);

        /**
        * Itineramos por cada uno de ellos
        */
        if ($authors) foreach($authors as $author) {?>

            <strong class="by-user"><a class="classic-link site-palette-yang-1-color" href="<?php echo get_author_posts_url($author->ID);?>"><?php echo $author->display_name;?></a></strong>

        <?php } ?>
      </span>

      <?php if (
        isset($template->options['displays'])
        && isset($template->options['displays']['post_date'])
        && $template->options['displays']['post_date']
      )  {?>
      <span class="typo-size-xsmall  margin-left-5  ornament-point-before-amper" >
        <span class="opacity-05"> <?php echo sprintf(__('on %s', THEME_TEXTDOMAIN), get_the_date());?></span>
      </span>
      <?php } ?>







  </div>
  </div>


  <div  class="site-typeface-body opacity-05 typo-size-xsmall post-item-meta  " >

          <?php
          if (
    				isset($template->options['displays'])
    				&& isset($template->options['displays']['post_comments_count'])
    				&& $template->options['displays']['post_comments_count']
    			)  {?>
          <span class="margin-right-5">
            <i class="material-icons">comment</i> <?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', THEME_TEXTDOMAIN ), number_format_i18n( get_comments_number() ) );?>
          </span>
          <?php } ?>

          <?php
          if (
    				isset($template->options['displays'])
    				&& isset($template->options['displays']['post_read_time'])
    				&& $template->options['displays']['post_read_time']
    			)  { ?>
          <?php if (function_exists('KTT_post_display_read_time_is_active') && KTT_post_display_read_time_is_active()) { ?>
          <span style="vertical-align:middle" class="margin-right-5  ornament-point-before">
            <i class="material-icons">access_time</i> <?php echo sprintf(__('%s min read', THEME_TEXTDOMAIN), KTT_display_post_read_time());?>
          </span>
          <?php } ?>
          <?php } ?>

  </div>


  <?php


}





/**
* Este hook se encarga de arreglar el numero de posts si estamos usando la template
* literatum grid mosaic. Gracias a este codigo modiicamos el numeo de posts para intentar
* que nunca aparezca un huevo en blanco en el mosaico de posts
*/
function KTT_fix_template_grid_posts_list( $query ) {

    /**
    * Primero debemos detectar si estamos usando la template que requiere este arreglo
    */
    $template = KTT_get_current_theme_template();

    /**
    * Si no hay template salimos de aqui
    */
    if (!$template) return;

    /**
    * Si no estamos usando la template que buscamos salimos de aqui tal cual
    */
    if ($template->id != 'template-literatum-grid.php') return;

    /**
    * Si hemos llegado hasta aqui significa que estamos usando la template que buscamos, por lo tanto
    * debemos corregir el número de posts
    */
    $query->set('posts_per_page', get_option( 'posts_per_page' ) + 1);

}
add_action( 'pre_get_posts', 'KTT_fix_template_grid_posts_list' );



/**
* Esta funcion se encarga de mostrar el video header del primer post mostrado en la plantilla
* grid si tiene uno
*/
/**
* Esta funcion se encarga de marcar como activo el video header si estamos en un pagina
* single y el post tiene un video featured
*/
function KTT_display_first_post_video_header($value) {

		/**
		* Si no estamos en una pagina single entonces nanay
		*/
    if (!is_home()) return $value;

    /**
    * Obtenemos la template que tenemos en la home
    */
		$current_template = KTT_get_current_theme_template();

    /**
    * Si no hemos obtenido template o la template no es la que buscamos salimos de aqui
    */
    if (!$current_template || $current_template->id != 'template-literatum-grid.php') return $value;

    /**
    * Si hemos llegado hasta aqui significa que estamos en la home y que la home
    * tiene la plantilla que necesita que habilitemos el video para su primer post
    * por lo tanto vamos a ver en primer lugar si el primer post de la query tiene
    * definido un video, si no es asi salimos de aqui
    */
    global $wp_query;
    $post = array_slice($wp_query->posts, 0, 1);

		/**
		* Si el post actuali tiene video configurado entonces devolvemos un true por aqui
		*/
		if (isset($post->post_featured_video) && isset($post->post_featured_video['src']) && $post->post_featured_video['src']) return true;

		/**
		* Por ultimo, si hemos llegado hasta aqui, devolvemos el value
		*/
		return $value;

}
add_filter('is_header_video_active', 'KTT_display_first_post_video_header', 5, 1);







/**
* Este hook se encarga de modificar la funcion que obtiene la url del video para sustutiirla con
* la url del video featured del post si este tiene uno configurado
*/
function KTT_replace_header_video_with_post_featured_video_url_in_home_template($url) {


		/**
    * Si no esta activo salimos de aqui
    */
    if (!is_header_video_active()) return $url;


    /**
		* Obtenemos el objeto completo
		*/
		global $post;
		if (isset($post->post_featured_video) && isset($post->post_featured_video['src']) && $post->post_featured_video['src']) return $post->post_featured_video['src'];

		/**
		* Si hemos llegado hasta qui devolvemos la url
		*/
		return $url;

}
add_filter('get_header_video_url', 'KTT_replace_header_video_with_post_featured_video_url_in_home_template', 5, 1);
