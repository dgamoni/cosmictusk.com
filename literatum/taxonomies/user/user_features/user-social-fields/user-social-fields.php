<?php
/**
 * Add extra contact fields to the user edit page
 *
 */

/**
* Esta funcion devuelve un array con informacion sobre todos los fields
* que queremos añadir
*/
function KTT_get_user_social_fields() {

    $result = array();

    /**
    * Facebook
    */
    $result[ktt_var_name('user_facebook')]['id'] = 'facebook';
    $result[ktt_var_name('user_facebook')]['label'] = __('Facebook username', THEME_TEXTDOMAIN);
    $result[ktt_var_name('user_facebook')]['icon'] = 'icon-facebook';
    $result[ktt_var_name('user_facebook')]['url'] = 'https://facebook.com/';

    /**
    * Twitter
    */
    $result[ktt_var_name('user_twitter')]['id'] = 'twitter';
    $result[ktt_var_name('user_twitter')]['label'] = __('Twitter username', THEME_TEXTDOMAIN);
    $result[ktt_var_name('user_twitter')]['icon'] = 'icon-twitter';
    $result[ktt_var_name('user_twitter')]['url'] = 'https://twitter.com/';

    /**
    * Twitter
    */
    $result[ktt_var_name('user_instagram')]['id'] = 'instagram';
    $result[ktt_var_name('user_instagram')]['label'] = __('Instagram username', THEME_TEXTDOMAIN);
    $result[ktt_var_name('user_instagram')]['icon'] = 'icon-instagram';
    $result[ktt_var_name('user_instagram')]['url'] = 'https://instagram.com/';

    /**
    * Devolvemos el array
    */
    return $result;

}


/**
* Esta funcion se encarga simplemente de devolver una lista en array con las ids
* de todos los contact fields que puede tener un user
*/
function KTT_get_user_social_fields_ids() {

    /**
    * Obtenemos la lista completa
    */
    $list = KTT_get_user_social_fields();

    /**
    *
    */
    $list = wp_list_pluck($list, 'label', 'id');

    /**
    * Devolvemos la lista
    */
    return $list;
}


/**
* Añadimos los inputs que queremos a los perfiles de usuarios
*/
function KTT_add_contactmethods( $contactmethods ) {

    /**
    * Obtenemos el arrays
    */
    $methods = KTT_get_user_social_fields();

    /**
    * Itineramos por cada uno de los contact methods y lo vamos
    * añadiendo a la lista
    */
    foreach ($methods as $key => $method) $contactmethods[$key] = $method['label'];

    /**
    * Devolvemos el arrays
    */
    return $contactmethods;

}
add_filter( 'user_contactmethods', 'KTT_add_contactmethods', 10, 1 );


?>
