<?php

/**
* Obtenemos los datos de la funcion get_avatar para sustituir el avatar
* del usuario si este tiene un avatar registrado en el sitio
*/
function KTT_update_avatar_image_url( $args, $id_or_email) {

    /**
    * Si es una id obtenemos el user_id
    */
    if ( is_numeric($id_or_email) ) {

        /**
        * Obtenemos el usuario
        */
        $user = KTT_get_user_by('ID', $id_or_email);

    } elseif (is_string($id_or_email) && is_email($id_or_email)) {

        /**
        * Obtenemos el usuario
        */
        $user = @KTT_get_user_by('email', $id_or_email);

    } else {

        /**
        * Obtenemos el usuario
        */
        $user = KTT_get_user_by('ID', $id_or_email->user_id);

    }



    /**
    * Chequeamos si el usuario tiene avatar
    */
    if ($user) if (isset($user->data->user_avatar)) if ($user->data->user_avatar) {

        /**
        * Obtenemos la url del avatar
        */
        $args['url'] = KTT_scaled_image_url($user->data->user_avatar, 'thumbnail');

    }

    /**
    * Devolvemos la lista de argumentos
    */
    return $args;
}
add_filter( 'get_avatar_data' , 'KTT_update_avatar_image_url' , 1 , 2 );



 ?>
