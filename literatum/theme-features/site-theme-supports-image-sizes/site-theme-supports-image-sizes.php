<?php
/**
* Definimos tamaños de imagen personalizados
*/
add_action( 'after_setup_theme', 'KTT_custom_image_sizes' );
function KTT_custom_image_sizes() {

    /**
    * Imagen thumbnail de 500x500px
    */
    add_image_size( 'square500', 500, 500, true ); // (cropped)

    /**
    * Imagen thumbnail de 500x500px
    */
    add_image_size( 'square1000', 1000, 1000, true ); // (cropped)
}



/**
* Ese hook se encarga de añadir la opcion a los dropdowns del media library
*/
add_filter( 'image_size_names_choose', 'KTT_custom_images_sizes_dropdown' );
function KTT_custom_images_sizes_dropdown( $sizes ) {
    return array_merge( $sizes, array(
        'square500' => __( 'Square 500' ),
        'square1000' => __( 'Square 1000' ),
    ) );
}



 ?>
