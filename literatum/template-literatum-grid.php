<?php
/*
Template Name: Featured Post + Photo Grid
Template Post Type: frontpage
Template Styles: template-grid
*/



if(isset($config_mode) && $config_mode){


		// add option to admin panel

		$options   = array();
		$options['displays']['option_name']           	= __('Display / Hide Elements', THEME_TEXTDOMAIN);
		$options['displays']['option_description']     	= __("Check the elements to display in this template.", THEME_TEXTDOMAIN);
		$options['displays']['option_priority'] 				= 1;
		$options['displays']['option_type']            	= 'checkboxes';
		$options['displays']['option_type_vars']				= array(
																											'post_categories' => __('Post categories', THEME_TEXTDOMAIN),
																											'post_share_buttons' => __('Share buttons', THEME_TEXTDOMAIN),
																											'post_author' => __('Post author', THEME_TEXTDOMAIN),
																											'post_date'	=> __('Post date', THEME_TEXTDOMAIN),
																											'post_comments_count' => __('Post comments count', THEME_TEXTDOMAIN),
																											'page_load_more' => __('Load more button', THEME_TEXTDOMAIN),
																										);
		$options['displays']['option_default']					= array(
																											'post_categories' => 1,
																											'post_share_buttons' => 1,
																											'post_author' => 1,
																											'post_date' => 0,
																											'post_comments_count' => 1,
																											'page_load_more' => 0,
																										);
		/**
		* Si tenemos la opcion de read time activa en el theme la añadimos como opcion
		* en el array
		*/
		if (function_exists('KTT_post_display_read_time_is_active') && KTT_post_display_read_time_is_active()) {
			$options['displays']['option_type_vars']['post_read_time'] = __('Post read time', THEME_TEXTDOMAIN);
			$options['displays']['option_default']['post_read_time'] = 1;
		}


		/**
		* Devolvemos la lista de opciones
		*/
    return $options;
}















global $template;
$featured_post = '';
$featured_post = array_shift($posts);


/**
* Empieza la template
*/
get_header();

?>




<div flex id="site-body"   class="template-masonry-default site-palette-yin-1-background-color site-palette-yang-2-color">





			<?php if ($featured_post) {
					$post = $featured_post;
					?>
					<?php
					/**
					* Vamos a formar el array de arguemntos que le pasaremos a la funcion que se encarga
					* realmente de mostrar el div
					*/
					$args = array(
								"card_id" => "card-post-" . $featured_post->ID,
								"card_classes" => "min-height-100vh text-align-center backdrop-gradient-1 site-palette-yang-1-color",

								/**
								* Obtenemos los datos de la imagen header
								*/
								"card_background_attachment" => get_post_thumbnail_id( $featured_post->ID ),

								"card_image_large" => KTT_scaled_image_url(get_post_thumbnail_id( $featured_post->ID ), 'full'),

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
					?><div id="<?php echo $post->ID;?>" flex="100" ><?php
					KTT_display_image_card($args);
					?></div> <?php
				} ?>






      <?php
			global $wp_query;
			if (!$wp_query->posts) {?>
          <div flex >
            <div class="typo-size-xxxlarge icon-emo-unhappy"></div>
            <div class="typo-size-medium padding-top-20 typo-weight-300"><?php _e('Sorry, no results found.', THEME_TEXTDOMAIN);?></div>
          </div>
      <?php } ?>



      <?php if (have_posts()) : ?>
        <div
        id="posts-list"
        layout-wrap
				layout="row" layout-xs="column"
        class="text-align-left posts-list">
          <?php foreach ($posts as $post) {;


					/**
					* Vamos a formar el array de arguemntos que le pasaremos a la funcion que se encarga
					* realmente de mostrar el div
					*/
					$args = array(
								"card_id" => "card-post-" . $post->ID,
								"card_classes" => "height-50vw backdrop-gradient-1 padding-both-40 text-align-left min-height-400px site-palette-yang-1-color",

								/**
								* Obtenemos los datos de la imagen header
								*/
								"card_background_attachment" => get_post_thumbnail_id( $post->ID ),

								"card_image_large" => KTT_scaled_image_url(get_post_thumbnail_id( $post->ID ), 'large'),

								/**
								* Llamamos ala funcion que se encarga de crear el contenido del site header
								* pasamos solo el nombre de la fucnion porque este parametro actua como un callback
								*/
								"card_content" => "KTT_post_item_list_cover",

								/**
								* Lo alineamos como queremos.
								*/
								"card_align" => "end start",



					);


					/**
					* Ejecutamos la funcion que realmente se encarga de mostrar el header
					*/
					?><div id="<?php echo $post->ID;?>" flex="33" flex-xs="100" flex-sm="50" ><?php
					KTT_display_image_card($args);
					?></div>



  				<?php }; ?>
        </div>
      <?php endif; ?>


			<?php
      /**
      * Si tenemos mas posts mostramos un boton de cargar más
      */
			if (
				isset($template->options['displays'])
				&& isset($template->options['displays']['page_load_more'])
				&& $template->options['displays']['page_load_more']
			)  {
      $pagination_links = KTT_get_next_previous_links();
			if ($pagination_links['previous']['url']) { ?>
			<a id="load-more" href="<?php echo $pagination_links['previous']['url'];?>" class="site-tipeface-caption-1 button-behaviour display-block typo-size-small padding-both-20">
				<i class="material-icons typo-size-xxlarge">more_horiz</i> <?php _e('Load more', THEME_TEXTDOMAIN);?>
			</a>
			<?php };}; ?>


</div>







<?php
get_footer();
