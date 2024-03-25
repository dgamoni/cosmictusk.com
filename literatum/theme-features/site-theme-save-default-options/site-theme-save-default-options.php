<?php
/**
* Este script se encarga de interceptar el hook que solo se dispara cuando se activa
* el theme y guardar en la database todas las opciones por defecto
*/
function KTT_save_default_theme_options () {

  /*+
  * Obtenemos todas las opciones por defecto del starter-content
  */
  $defaults = KTT_get_starter_content_data();

  /**
  * Del array de defaults solo nos interesa las "options" asi que si no
  * encontramos ninguna salimos de aqui
  */
  if (!isset($defaults['options']) && !$defaults['options']) return;


  /**
  * Vamos a itinerar por cada una de las opciones por defecto y comprobaremos una por una
  * si dicha opcion ya existe en la database, si es asi la dejamos tal cual, pero si no existe
  * la creamos
  */
  foreach ($defaults['options'] as $option_id => $option_default) {

      /**
      * Obtenemos el value que ya tiene la opcion en nuestra ddbb
      */
      $value = get_option($option_id);

      /**
      * Si no tenemos value vamos a guardar la opcion
      */
      if (!$value) add_option($option_id, $option_default);


  }

}
add_action('after_switch_theme', 'KTT_save_default_theme_options');

 ?>
