<?php


// show the featured image in the categories list

function KTT_manage_my_post_tag_columns($columns) {
   // add 'My Column'
   $result = array();
   if ($columns) foreach ($columns as $column_key => $column) {
     $result[$column_key] = $column;
     if ($column_key == 'cb') $result['featured_image'] = 'Image';
   }
   return $result;;
}
add_filter('manage_edit-post_tag_columns','KTT_manage_my_post_tag_columns');



function KTT_manage_post_tag_custom_fields($deprecated,$column_name,$term_id) {
     if ($column_name == 'featured_image') {
     	     $featured_image_id = get_taxonomy_meta($term_id, ktt_var_name('post_tag_featured_image'), true);
     	     $image_attributes = wp_get_attachment_image_src( $featured_image_id, 'thumbnail' );
    	     $post_featured_image_thumb = $image_attributes[0];

       	   echo '<span style="border-radius:3px;display:block;height:80px;width:80px;background-color:#f0f0f0;"><img style="margin:0;padding:0;border-radius:2px;max-width:80px;max-height:80px;" src="' . $post_featured_image_thumb . '"></span>';
     }
}
add_filter ('manage_post_tag_custom_column', 'KTT_manage_post_tag_custom_fields', 10,3);













/**
* we create the column
*/
function KTT_add_template_column_to_post_tag( $columns ){
    $columns['template'] = __('Template', THEME_TEXTDOMAIN);
    return $columns;
}
add_filter( "manage_edit-post_tag_columns", 'KTT_add_template_column_to_post_tag', 10);



function KTT_add_template_column_to_post_tag_content( $value, $column_name, $term_id ){
     if ($column_name == 'template') {

          /**
          * Obtenemos la template
          */
          $template = KTT_get_post_tag_template($term_id);

          /**
          * Mostramos el resultados
          */
          echo $template->name;

     }
}
add_action( "manage_post_tag_custom_column", 'KTT_add_template_column_to_post_tag_content', 10, 3);




?>
