<?php
/*
Template Name: Simple with Featured Image
Template Post Type: post
Template Styles: template-single
Template Description: This template display the post with the post's featured image as cover in the header.
*/


if(isset($config_mode) && $config_mode){



    // add option to admin panel

    $args                           = array();
		//$args['option_id']              = ktt_var_name('template_' . $template_data->id . '_option_displays');
		$args['displays']['option_name']           	= __('Display / Hide Elements', THEME_TEXTDOMAIN);
		$args['displays']['option_description']     = __("Check the elements to display in this template.", THEME_TEXTDOMAIN);
		$args['displays']['option_priority'] 				= 1;
		$args['displays']['option_type']            = 'checkboxes';
		$args['displays']['option_type_vars']				= array(
          																				'post_categories' => __('Post categories', THEME_TEXTDOMAIN),
          																				'post_share_buttons' => __('Share buttons', THEME_TEXTDOMAIN),
          																				'post_author' => __('Post author', THEME_TEXTDOMAIN),
          																				'post_comments_count' => __('Post comments count', THEME_TEXTDOMAIN),
                                                  'page_navigation' => __('Navigation buttons', THEME_TEXTDOMAIN),
                                                  'page_next_post' => __('Next post preview', THEME_TEXTDOMAIN),
          																			);
		$args['displays']['option_default']				  = array(
          																				'post_categories' => 1,
          																				'post_share_buttons' => 1,
          																				'post_author' => 1,
          																				'post_comments_count' => 1,
                                                  'page_navigation' => 1,
                                                  'page_next_post' => 1,
          																			);

		/**
		* Si tenemos la opcion de read time activa en el theme la añadimos como opcion
		* en el array
		*/
		if (function_exists('KTT_post_display_read_time_is_active') && KTT_post_display_read_time_is_active()) {
			$args['displays']['option_type_vars']['post_read_time'] = __('Post read time', THEME_TEXTDOMAIN);
			$args['displays']['option_default']['post_read_time'] = 1;
		}





    // setting
    $args['content_width']['option_name']           	= __('Body content width', THEME_TEXTDOMAIN);
		$args['content_width']['option_description']      = __("Select the maximum width dimension in the paragraphs and main contents in this template.", THEME_TEXTDOMAIN);
		$args['content_width']['option_priority'] 				= 1;
		$args['content_width']['option_type']             = 'css_select';
    $args['content_width']['option_type_vars']		    = array(
                              														'selector' => '#site-body .site-body-content-wrap .site-body-content p, #site-body .site-body-content-wrap .site-body-content span, #site-body .site-body-content-wrap .site-body-content h1, #site-body .site-body-content-wrap .site-body-content h2, #site-body .site-body-content-wrap .site-body-content h3, #site-body .site-body-content-wrap .site-body-content h4, #site-body .site-body-content-wrap .site-body-content h5, #site-body .site-body-content-wrap .site-body-content h6, #site-body .site-body-content-wrap .site-body-content ul, #site-body .site-body-content-wrap .site-body-content ol, #site-body .site-body-content-wrap .site-body-content hr',
                              														'property' => 'max-width',
                              														'label' => __('Adjust the width of the post content.', THEME_TEXTDOMAIN),
                                                          'values' => array(
                                                                '' => __('Default', THEME_TEXTDOMAIN),
                                                                '500px' => __('500 pixels', THEME_TEXTDOMAIN),
                                                                '600px' => __('600 pixels', THEME_TEXTDOMAIN),
                                                                '700px' => __('700 pixels', THEME_TEXTDOMAIN),
                                                                '800px' => __('800 pixels', THEME_TEXTDOMAIN),
                                                                '900px' => __('900 pixels', THEME_TEXTDOMAIN),
                                                                '1000px' => __('1000 pixels', THEME_TEXTDOMAIN),
                                                                '1100px' => __('1100 pixels', THEME_TEXTDOMAIN),
                                                                '1200px' => __('1200 pixels', THEME_TEXTDOMAIN),
                                                          ),
                              												);
    $args['content_width']['option_default'] 		      = array('value' => '');



    return $args;
}








global $template;
get_header();
?>


    <div flex id="site-body" class="site-palette-yang-1-background-color site-palette-yin-2-color">


        <?php
        /**
        * Vamos a formar el array de arguemntos que le pasaremos a la funcion que se encarga
        * realmente de mostrar el div
        */
        $args = array(
              "card_id" => "card-post-" . $post->ID,
              "card_classes" => "height-100vh text-align-center min-height-600px basic-sideheader  backdrop-gradient-1 site-palette-yang-1-color",

              /**
              * Obtenemos los datos de la imagen header
              */
              "card_background_attachment" => get_post_thumbnail_id( $post->ID ),

              "card_image_large" => KTT_scaled_image_url(get_post_thumbnail_id( $post->ID ), 'full'),

              /**
              * Llamamos ala funcion que se encarga de crear el contenido del site header
              * pasamos solo el nombre de la fucnion porque este parametro actua como un callback
              */
              "card_content" => "KTT_post_cover",

              /**
              * Lo alineamos como queremos.
              */
              "card_align" => "space-between center",

              "card_video" => true,

        );


        /**
        * Ejecutamos la funcion que realmente se encarga de mostrar el header
        */
        ?><div id="<?php echo $post->ID;?>" class=" post-item" flex="100" ><?php
        KTT_display_image_card($args);
        ?></div>





    		<article class="site-body-content-wrap padding-top-40">
    			<div class="site-typeface-content padding-top-40 site-body-content padding-left-0 padding-bottom-40 padding-right-0 typo-size-content">



            <?php if (have_posts()) : ?>
    				<?php while (have_posts()) : the_post(); ?>


                        <?php the_content();?>

                        <?php
                        /**
                        * Tags list!
                        */
                        ?>
                        <p>
                          <?php KTT_post_display_html_tags($post->ID)?>
                        </p>


    				<?php endwhile; ?>
    				<?php endif; ?>









    			</div>
    		</article>



        <?php
        if (
  				isset($template->options['displays'])
  				&& isset($template->options['displays']['page_navigation'])
  				&& $template->options['displays']['page_navigation']
  			)  {?>




            <div class=" site-body-content-wrap  padding-both-20 text-align-center">
            <div class="text-align-left margin-auto max-width-700px comments-area  padding-bottom-50">


                <div class="padding-both-40"><hr class="site-palette-yang-4-border-color"></div>


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

            </div>
            </div>
        <?php } ?>






        <div id="comments-container" class="margin-top-20 site-body-content-wrap site-palette-yin-2-color padding-top-50 padding-bottom-50 text-align-center site-palette-yang-3-background-color">
        <div id="comments" class="text-align-left margin-auto margin-top-50 margin-bottom-50 max-width-700px comments-area padding-both-40">
        <?php
          // If comments are open or we have at least one comment, load up the comment template
          if ( comments_open() || '0' != get_comments_number() ) :
            comments_template();
          endif;
        ?>
        
        <script type='text/javascript' src='https://the-cosmic-tusk.disqus.com/embed.js'></script>

        </div>
        </div>









        <?php
        if (
  				isset($template->options['displays'])
  				&& isset($template->options['displays']['page_next_post'])
  				&& $template->options['displays']['page_next_post']
  			)  {?>

        <?php
        $next_post = get_previous_post();
        if ($next_post) {


        if (!function_exists('KTT_next_post_cover')) {

          function KTT_next_post_cover($post) {

          ?>
          <div class="padding-both-40">
          </div>

          <div class="padding-both-40 text-align-left" >
          <div class=" max-width-700px typography-responsive" >


              <a href="<?php echo get_permalink($post->ID);?>" class="site-palette-yang-1-color display-block padding-top-20 padding-bottom-20">
                  <span style="" class="site-palette-yin-1-color border-radius-3 padding-left-10 padding-right-10 site-palette-yang-1-background-color typo-size-xsmall opacity-05 display-inline-block margin-bottom-20"><?php _e('Next article', THEME_TEXTDOMAIN);?></span>
                  <div class="text-shadow-1  classic-link site-palette-yang-1-color typo-size-xxxlarge site-typeface-title padding-bottom-20">
                    <?php echo KTT_get_post_title_formated($post);?>
                  </div>
                  <div class="site-typeface-headline site-palette-yang-2-color font-weight-300 opacity-05 typo-size-medium">
                    <?php echo KTT_get_post_subtitle_formated($post->ID);?>
                  </div>
              </a>

          </div>
          </div>

          <div class="padding-both-40">
          </div>


          <?php

          }
        }

        /**
        * Vamos a formar el array de arguemntos que le pasaremos a la funcion que se encarga
        * realmente de mostrar el div
        */
        $args = array(
              "card_id" => "card-post-" . $next_post->ID,
              "card_classes" => "height-500px text-align-center background-opacity-black-05 min-height-500px  site-palette-yang-1-color",

              /**
              * Obtenemos los datos de la imagen header
              */
              "card_background_attachment" => get_post_thumbnail_id( $next_post->ID ),

              /**
              * Llamamos ala funcion que se encarga de crear el contenido del site header
              * pasamos solo el nombre de la fucnion porque este parametro actua como un callback
              */
              "card_content" => array("KTT_next_post_cover", $next_post),

              /**
              * Lo alineamos como queremos.
              */
              "card_align" => "space-between center",
              "card_video" => false,

        );


        /**
        * Ejecutamos la funcion que realmente se encarga de mostrar el header
        */
        ?><div id="<?php echo $next_post->ID;?>" class=" " flex="100" ><?php
        KTT_display_image_card($args);
        ?></div>
        <?php } ?>
        <?php } ?>













    </div>





<?php
get_footer();
