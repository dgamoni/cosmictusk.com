<?php
/*
Template Name: Simple Page
Template Post Type: page
Template Styles: template-single
Template Description: Default template for pages.
*/


if(isset($config_mode) && $config_mode){


    // add option to admin panel

		$options                                        = array();
		$options['displays']['option_name']           	= __('Display / Hide Elements', THEME_TEXTDOMAIN);
		$options['displays']['option_description']      = __("Check the elements to display in this template.", THEME_TEXTDOMAIN);
		$options['displays']['option_priority'] 				= 1;
		$options['displays']['option_type']             = 'checkboxes';
		$options['displays']['option_type_vars']				= array(
              																				'page_navigation' => __('Navigation buttons', THEME_TEXTDOMAIN),
              																			);
		$options['displays']['option_default']				  = array(
              																				'page_navigation' => 1,
              																			);

    /**
    * Devolvemos la lsita de opciones
    */
    return $options;
}




global $template;
get_header();
?>


    <div flex id="site-body" class="site-palette-yang-1-background-color site-palette-yin-2-color">

        <?php echo KTT_display_sideheader();?>

    		<div class="site-body-content-wrap padding-both-40 max-width-1500">
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



                  <div class="padding-both-30"></div>



    				<?php endwhile; ?>
    				<?php endif; ?>

    			</div>
    		</div>


        <?php
        if (
  				isset($template->options['displays'])
  				&& isset($template->options['displays']['page_navigation'])
  				&& $template->options['displays']['page_navigation']
  			)  {?>
        <div class=" site-body-content-wrap  padding-both-20 text-align-center">
        <div class="text-align-left margin-auto max-width-700px comments-area  padding-bottom-50">

            <hr class="site-palette-yang-4-border-color">
            <div class="padding-both-20"></div>

            <?php
            /**
            * Obtenemos los links de anterior y siguiente
            */
            $pagination_links = KTT_get_next_previous_links();
            ?>

            <p class="site-typeface-body  typo-size-xsmall text-align-center padding-bottom-50 max-width-1000px margin-auto" layout="row">

                <span flex>

                  <?php if ($pagination_links['next']['url']) {?>
                    <a
                    class="site-palette-yin-3-color display-block border-style-solid  md-whiteframe-2dp border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 button-behaviour padding-bottom-10 "
                    title="<?php echo $pagination_links['next']['title'];?>"
                    href="<?php echo $pagination_links['next']['url'];?>">
                      <span class="icon-left-hand"></span> <?php echo $pagination_links['next']['label'];?>
                    </a>
                  <?php } else {?>
                    <span class="display-block border-style-solid opacity-03 border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 padding-bottom-10"><span class="icon-left-hand"></span> <?php echo $pagination_links['next']['label'];?></span>
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
                    <a class="site-palette-yin-3-color  display-block border-style-solid  md-whiteframe-2dp border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 button-behaviour padding-bottom-10 " title="<?php echo $pagination_links['previous']['title'];?>" href="<?php echo $pagination_links['previous']['url'];?>">
                      <?php echo $pagination_links['previous']['label'];?> <span class="icon-right-hand"></span>
                    </a>
                  <?php }else {?>
                    <span class="opacity-03 display-block border-style-solid border-width-2 border-radius-5 padding-top-10 padding-left-20 padding-right-20 padding-bottom-10 "><?php echo $pagination_links['previous']['label'];?> <span class="icon-right-hand"></span></span>
                  <?php } ?>

                </span>

            </p>

        </div>
        </div>
        <?php } ?>



    </div>





<?php
get_footer();
