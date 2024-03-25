<?php
/*
Template Name: Masonry Columns
Template Post Type: category, post_tag, user, archive, search, frontpage
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

<style>
@media screen and (max-width: 800px){
	#posts-list[data-columns]::before {
		content: '1 .column.size-1of1';
	}
}
@media screen and (min-width: 800px) and (max-width: 1120px) {
	#posts-list[data-columns]::before {
		content: '2 .column.size-1of2';
	}
}
@media screen and (min-width: 1120px) and (max-width: 1700px) {
	#posts-list[data-columns]::before {
		content: '3 .column.size-1of3';
	}
}
@media screen and (min-width: 1700px) {
	#posts-list[data-columns]::before {
		content: '4 .column.size-1of4';
	}
}
/*#posts-list[data-columns]::before {content: '2 .column.size-1of2';}*/
/*#posts-list[data-columns] > .column > div + div {border-style:solid;border-width: 1px 0 0px 0;}*/
#posts-list[data-columns] > .column > div {border-style:solid;border-width: 0px 0 1px 0;}
#posts-list[data-columns] > .column {border-style:solid;border-width: 0 1px 0px 0;}
#posts-list[data-columns] > .column:last-child {border-width: 0;}

/* These are the classes that are going to be applied: */
.column { float: left; }
.size-1of1 { width: 100%; }
.size-1of2 { width: 50%; }
.size-1of3 { width: 33.333%; }
.size-1of4 { width: 25%; }
</style>

<div flex id="site-body"   class="template-masonry-default site-palette-yang-1-background-color site-palette-yin-2-color">


			<?php echo KTT_display_sideheader();?>

      <?php if (!$wp_query->posts) {?>
          <div flex >
            <div class="typo-size-xxxlarge icon-emo-unhappy"></div>
            <div class="typo-size-medium padding-top-20 typo-weight-300"><?php _e('Sorry, no results found.', THEME_TEXTDOMAIN);?></div>
          </div>
      <?php } ?>



      <?php if (have_posts()) : ?>
        <div
        id="posts-list"
        data-columns
				layout="row"
				layout-align="center stretch"
        class="text-align-left">
          <?php while (have_posts()) : the_post(); ?>

                <div

                style="vertical-align:top;"
                class=" site-palette-yang-3-border-color padding-both-50">

                  <?php
                  $thumb = get_post_thumbnail_id($post->ID);
                  if ($thumb) {?>
                    <a class="classic-link site-palette-special-1-color" title="<?php the_title();?>" href="<?php the_permalink();?>">
                    <img class="display-block border-radius-3 padding-bottom-20" style="width:100%" src="<?php echo KTT_scaled_image_url(get_post_thumbnail_id($post->ID), 'large');?>">
                    </a>
                  <?php } ?>

                  <a title="<?php the_title();?>" href="<?php the_permalink();?>" class="classic-link display-block site-palette-yin-2-color padding-bottom-5 site-typeface-title typo-size-large post-title">
                    <?php echo strip_tags(KTT_get_the_title(), '<strong><b><i><em><u>');?>
                  </a>

                  <?php //if ($post->post_subtitle) {?>
                  <h2 class="typo-weight-300 site-palette-yin-3-color padding-top-5 padding-bottom-0 site-typeface-headline typo-size-small ">
                    <?php echo strip_tags(KTT_get_the_subtitle(), '<strong><b><i><em><u>');?>
                  </h2>
                  <?php //} ?>

                  <div class="typo-size-xsmall"><?php the_excerpt();?></div>

                  <div
                  class="padding-top-20 typo-size-xsmall"
                  layout-align="space-between center"
                  layout="row">
                    <div><a class="classic-link site-palette-special-1-color" title="<?php the_title();?>" href="<?php the_permalink();?>"><?php _e('Continue reading', THEME_TEXTDOMAIN);?></a></div>
                    <div></div>
                  </div>

                </div>
  				    <?php endwhile; ?>
        </div>
      <?php endif; ?>







			<hr style="margin-top:-1px" class="margin-auto site-palette-yang-3-border-color">
			<div class="padding-both-0"></div>

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


			<div class="padding-both-20"></div>

</div>



<?php
global $wp_scripts;
$salvattore_url = '';
if (isset($wp_scripts->registered[THEME_TEXTDOMAIN . '-salvattore.min'])) $salvattore_url = $wp_scripts->registered[THEME_TEXTDOMAIN . '-salvattore.min']->src;
if ($salvattore_url) {
?>
<script>
jQuery.getScript( "<?php echo $salvattore_url;?>", function( data, textStatus, jqxhr ) {
	jQuery('#posts-list > .column').addClass("site-palette-yang-3-border-color");
});
</script>
<?php } ?>

<?php
get_footer();
