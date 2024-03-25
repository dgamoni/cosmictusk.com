<?php
/**
* Esta funcionalidad nos permite implementar plantillas de colores en le theme
* Version 1.2
*/



/**
* Esta funcion se encarga de devolver la lista de templates de colores
* registradas en el sitiio
*/
function KTT_get_theme_color_templates() {

      /**
      * Una template debera tener este formato
      * [template_id] = array(
      *   'id' => template_id,
      *   'name' => 'Nombre de la template',
      *   'description' => 'Descripcion de la template'
      *   'colors' => array(
      *     'yin' => array(
      *       'yin_1' => '#000000',
      *       'yin_2' => '#000000',
      *       'yin_3' => '#000000',
      *       'yin_4' => '#000000',
      *       'yin_special_1' => '#000000',
      *       'yin_special_2' => '#000000',
      *     )
      *     'yang' => array (
      *       'yang_1' => '#000000',
      *       'yang_2' => '#000000',
      *       'yang_3' => '#000000',
      *       'yang_4' => '#000000',
      *       'yang_special_1' => '#000000',
      *       'yang_special_2' => '#000000',
      *      )
      *
      *   )
      * )
      */

      /**
      * Registramos el array de resultados
      */
      $result = array();

      /**
      * Aplicamos un filter, esto nos permite añadir templates desde terceras funciones
      */
      $result = apply_filters('KTT_THEME_color_templates', $result);

      /**
      * Devolvemos el array con los resultados
      */
      return $result;

}



/**
* Esta funcion se encarga de obtener la template que se haya indicado como parametro
*/
function KTT_get_theme_color_template($template_id) {

      /**
      * En primer lugar obtenemos la lista completa de tempaltes
      */
      $templates = KTT_get_theme_color_templates();

      /**
      * si la id que buscamos no se encuentra en la lista devolvemos un false
      */
      if (!isset($templates[$template_id])) return;

      /**
      * Devolvemos la template
      */
      return $templates[$template_id];

}



/**
* A partir de la template sacamos el css que forma los colores
*/
function KTT_get_theme_color_template_css($template_id) {

      /**
      * Definimos el css var
      */
      $css = '';

      /**
      * Definimos las properties que vamos a definir en el css
      */
      $properties = array('color', 'background-color', 'border-color');

      /**
      * obtenemos la template
      */
      $template = KTT_get_theme_color_template($template_id);

      /**
      * Si no hay template id salimos de aqui
      */
      if (!$template) return;

      /**
      * Si no hay colores salimos de aqui
      */
      if (!isset($template['colors']) && !$template['colors']) return;





      foreach ($template['colors']['yang_special'] as $color_id => $color_value) {
          $css_array = array();
          $css_array['selector'] = ' .color-template-' . $template_id;
          foreach ($template['colors']['yang'] as $base_id => $base_value) {
            $css_array['selector'] .= ' .' . str_replace('_', '-', $base_id) . '-color a,';
          }
          $css_array['selector'] = substr($css_array['selector'], 0, -1);
          $css_array['color'] = $color_value;
          $css .= KTT_theme_css_option_array_to_code($css_array);
          break;
      }

      foreach ($template['colors']['yin_special'] as $color_id => $color_value) {
          $css_array = array();
          $css_array['selector'] = ' .color-template-' . $template_id;
          foreach ($template['colors']['yin'] as $base_id => $base_value) {
            $css_array['selector'] .= ' .' . str_replace('_', '-', $base_id) . '-color a,';
          }
          $css_array['selector'] = substr($css_array['selector'], 0, -1);
          $css_array['color'] = $color_value;
          $css .= KTT_theme_css_option_array_to_code($css_array);
          break;
      }







      foreach ($template['colors']['yang'] as $color_id => $color_value) {
          $css_array = array();
          $css_array['selector'] = ' .color-template-' . $template_id;
          $css_array['selector'] .= ' .' . str_replace('_', '-', $color_id) . '-background-color a';

          $var = array_slice($template['colors']['yin_special'], 0, 1);
          $first = array_shift($var);
          $css_array['color'] = $first;
          $css .= KTT_theme_css_option_array_to_code($css_array);
          break;
      }

      /**
      * Esto se encarga de poner los links de color claro en fondo oscuros y viceversa
      */
      foreach ($template['colors']['yin'] as $color_id => $color_value) {
          $css_array = array();
          $css_array['selector'] = ' .color-template-' . $template_id;
          $css_array['selector'] .= ' .' . str_replace('_', '-', $color_id) . '-background-color a';

          $var = array_slice($template['colors']['yang_special'], 0, 1);
          $first = array_shift($var);
          $css_array['color'] = $first;
          $css .= KTT_theme_css_option_array_to_code($css_array);
          break;
      }











      foreach ($template['colors']['yin_special'] as $color_id => $color_value) {
        foreach ($properties as $property) {
          $css_array = array();
          $css_array['selector'] = ' .color-template-' . $template_id;
          foreach ($template['colors']['yin'] as $base_id => $base_value) {


            $css_array['selector'] .= ' .' . str_replace('_', '-', $base_id) . '-' . $property;
            $css_array['selector'] .= ' .' . str_replace('_', '-', $color_id) . '-' . $property . ',';


          }
          $css_array['selector'] = substr($css_array['selector'], 0, -1);
          $css_array[$property] = $color_value;
          $css .= KTT_theme_css_option_array_to_code($css_array);
        }




      }





      foreach ($template['colors']['yin_special'] as $color_id => $color_value) {
        foreach ($properties as $property) {
          $css_array = array();
          $css_array['selector'] = ' .color-template-' . $template_id;
          foreach ($template['colors']['yin'] as $base_id => $base_value) {


            $css_array['selector'] .= ' .' . str_replace('_', '-', $base_id) . '-' . $property;
            $css_array['selector'] .= ' .' . str_replace('_', '-', $color_id) . '-' . $property . ',';


          }
          $css_array['selector'] = substr($css_array['selector'], 0, -1);
          $css_array[$property] = $color_value;
          $css .= KTT_theme_css_option_array_to_code($css_array);
        }
      }













      /**
      * Itineramos por cada una de las properties y añadimos una card_classes
      * que defina un color para cada property
      */
      foreach ($properties as $property) {
          /**
          * Itineramos por cada uno de los colores
          */
          foreach ($template['colors']['yin'] as $color_id => $color_value) {

              $css_array = array();
              $css_array['selector'] = ' .color-template-' . $template_id . ' .' . str_replace('_', '-', $color_id) . '-' . $property ;
              $css_array['selector'] .= ', .color-template-' . $template_id . ' a.' . str_replace('_', '-', $color_id) . '-' . $property;
              $css_array[$property] = $color_value;

              $css .= KTT_theme_css_option_array_to_code($css_array);
          }

          foreach ($template['colors']['yang'] as $color_id => $color_value) {

              $css_array = array();
              $css_array['selector'] = ' .color-template-' . $template_id . ' .' . str_replace('_', '-', $color_id) . '-' . $property ;
              $css_array['selector'] .= ', .color-template-' . $template_id . ' a.' . str_replace('_', '-', $color_id) . '-' . $property;
              $css_array[$property] = $color_value;

              $css .= KTT_theme_css_option_array_to_code($css_array);
          }
      }






      /**
      * Devolvemos el css
      */
      return $css;


}
