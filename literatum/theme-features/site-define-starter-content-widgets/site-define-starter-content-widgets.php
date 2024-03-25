<?php

/**
* Registra las hojas de estilo que se utilizan en el sitio.
*/
function KTT_define_starter_content_widgets($result) {

      /**
      * Añadimos las opciones iniciales que debe tener el theme
      */
      $result['widgets']['main-sidebar-area'] = array('search');

      /**
      * Devolvemos el array completo
      */
      return $result;

}
add_filter('KTT_starter_content_data', 'KTT_define_starter_content_widgets', 10, 1);
