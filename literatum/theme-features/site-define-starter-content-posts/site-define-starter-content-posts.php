<?php

/**
* Registra las hojas de estilo que se utilizan en el sitio.
*/
function KTT_define_starter_content_posts($result) {

      /**
      * Añadimos las opciones iniciales que debe tener el theme
      */
      $result['posts']['post-dummy-1']['post_type'] = 'post';
      $result['posts']['post-dummy-1']['post_title'] = '5 Years Cruising the World, They Still Living the Dream';
      $result['posts']['post-dummy-1']['post_content'] = 'lorem ipsum...';

      /**
      * Devolvemos el array completo
      */
      return $result;

}
add_filter('KTT_starter_content_data', 'KTT_define_starter_content_posts', 10, 1);
