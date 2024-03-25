<?php
/**
 * Featured images for categories
 *
 */

 // add featured image option to category admin pages

 $args                          	 = array();
 $args['taxmeta_taxonomy']        = 'category';
 $args['taxmeta_id']              = ktt_var_name('category_featured_image');
 $args['taxmeta_name']            = __('Featured Image', THEME_TEXTDOMAIN);
 $args['taxmeta_description']     = __('Attach a featured image for the category.', THEME_TEXTDOMAIN);
 $args['taxmeta_type']            = 'image';

 $KTT_new_taxonomy_meta = new KTT_new_taxonomy_meta($args);
