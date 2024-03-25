<?php

/**
* Registra las hojas de estilo que se utilizan en el sitio.
*/
function KTT_define_starter_content_options($result) {

      /**
      * Añadimos las opciones iniciales que debe tener el theme
      */
      $result['options']['posts_per_page'] = 12;
      $result['options']['show_on_front'] = 'posts';

      /**
      * Devolvemos el array completo
      */
      return $result;

}
add_filter('KTT_starter_content_data', 'KTT_define_starter_content_options', 10, 1);
