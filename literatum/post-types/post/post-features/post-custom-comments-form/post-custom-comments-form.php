<?php
/**
* Editamos el formulario de crear comentario para adaptarlo al estilo del sitio
*/


/**
* Esta funcion utiliza el filter comment_form_fields para modificar los fields
* del formulario de commentarios y adaptarlo a nuestro estilo
*/
function KTT_custom_comments_field_comment_textarea($fields) {

      /**
      * Name fields
      */
      //$fields['author'] = '<p class="comment-form-author"><label for="author">Name <span class="required">*</span></label> <input class="site-palette-yin-2-color site-palette-yang-1-background-color border-radius-3 site-palette-4-background-color display-block width-100 padding-both-5" id="author" name="author" type="text" value="" size="30" maxlength="245" aria-required="true" required="required" /></p>';
      $fields['author'] = '<span class="display-block">' . $fields['author'] . '</span>';

      /**
      * email fields
      */
      //$fields['email'] = '<p class="comment-form-email"><label for="email">Email <span class="required">*</span></label> <input class="site-palette-yin-2-color site-palette-yang-1-background-color border-radius-3 display-block width-100 padding-both-5" id="email" name="email" type="email" value="" size="30" maxlength="100" aria-describedby="email-notes" aria-required="true" required="required" /></p>';
      $fields['email'] = '<span class="display-block">' . $fields['email'] . '</span>';

      /**
      * URL field
      */
      //$fields['url'] = '<p class="comment-form-url"><label for="url">Website</label> <input class="site-palette-yin-2-color site-palette-yang-1-background-color border-radius-3 display-block width-100 padding-both-5" id="url" name="url" type="url" value="" size="30" maxlength="200" /></p>';
      $fields['url'] = '<span class="display-block">' . $fields['url'] . '</span>';

      /**
      * Comment textarea
      */
      $fields['comment'] = '<p class="comment-form-comment"><textarea class="site-palette-yin-2-color site-palette-yang-1-background-color border-radius-3 display-block width-100 padding-both-20" placeholder="' . __('Leave your comment here...', THEME_TEXTDOMAIN) . '" id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea></p>';

      /**
      * Devolvemos la lista de fields
      */
      return $fields;

}
add_filter('comment_form_fields', 'KTT_custom_comments_field_comment_textarea');





// define the comment_form_submit_button callback
function filter_comment_form_submit_button( $submit_button, $args ) {

      /**
      * Editamos el submit button
      */
      $submit_button = '<span style="float:right;" class="display-block"><md-button class=" md-warn"> ' . __('Cancel', THEME_TEXTDOMAIN) . '</md-button>';
      $submit_button .= '<md-button name="' . $args['name_submit'] . '" type="submit" id="' . $args['id_submit'] . '" class=" icon-paper-plane md-raised md-primary ' . $args['class_submit'] . '"> ' . $args['label_submit'] . '</md-button></span>';
      $submit_button .= '<div style="clear:both"></div>';
      /**
      * Devolvemos el boton editado
      */
      return $submit_button;

};

// add the filter
add_filter( 'comment_form_submit_button', 'filter_comment_form_submit_button', 10, 2 );













/**
* Modificamos la clase del avatar de la funcion get_Avatar para añadir
* las clases que queramos
*/
function KTT_add_class_to_avatar($class) {
    $class = str_replace("class='avatar", "class='avatar border-radius-100", $class);
    return $class;
}
add_filter('get_avatar','KTT_add_class_to_avatar');

 ?>
