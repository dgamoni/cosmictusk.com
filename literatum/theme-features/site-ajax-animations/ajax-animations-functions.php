<?php
/**
* Regsitramos todas las funciones relacionadas con las animaciones ajax
*/


/**
* Esta funcion se encarga de determinar si tenemos activas en el sitio o no las animaciones
* para las transiciones ajax
*/
function KTT_is_ajax_transition_animations_active() {
  return get_option(ktt_var_name('ajax_transition_animation'));
}


/**
* Esta función se encarga de devolver la ruta donde están las dependencias de esta feature
*/
function KTT_get_ajax_animations_src_path() {
  return trailingslashit(dirname(__FILE__) . "/src");
}



/**
* Obtiene el effecto activo
*/
function KTT_get_current_ajax_animation_effect() {

    /**
    * Obtenemos la opcion
    */
    $effect_id = get_option(ktt_var_name('ajax_transition_animation'));

    /**
    * Si no tenemos effect devolvemos false
    */
    if (!$effect_id) return;

    /**
    * Devovlemos el effect completo
    */
    return KTT_get_ajax_animation_effect($effect_id);

}


/**
* Esta funcion se encarga de devolver un array con todas las rutas de los scripts que se encargan
* de cada uno de los efectos
*/
function KTT_get_ajax_animations_effects_files() {

    /**
    * Vamos a ir guardando las templates que encontremos en este array
    */
    $result = array();

    /**
    * Itineramos por cada una de las templates de categoria que encontremos
    */
    foreach (glob(dirname(__FILE__)  . "/effects/*.php") as $filename) $result[] = $filename;

    /**
    * Devolvemos el array con los resultados
    */
    return $result;

}


/**
* Esta funcion recibe la ruta de un script de efectos y obtiene un array con los datos de la misma
* obtenidos de los primeros bytes del file
*/
function KTT_get_ajax_animation_effect_data($file_path) {

    /**
    * En la variable result vamos guardando el resultados
    */
    $result = new stdClass();

    /**
    * Cremos un identificador unico para la template
    */
    $effect_id = basename($file_path);

    /**
    * Obtenemos la data de la template leyendo los primeros bytes del file
    */
    $args = array(
      'name' => 'Effect Name',
      'js_dependencies' => 'Scripts Dependencies',
      'css_dependencies' => 'CSS Dependencies'
    );
    $source = get_file_data($file_path, $args);


    /**
    * Guardamos los datos en el array de salida
    */
    $result->id = $effect_id;
    $result->name = $source['name'];
    if ($source['js_dependencies']) $result->dependencies['js'] = str_replace(' ', '', explode(',',$source['js_dependencies']));
    if ($source['css_dependencies']) $result->dependencies['css'] = str_replace(' ', '', explode(',',$source['css_dependencies']));
    $result->path = $file_path;

    /**
    * Devolvemos el resultado
    */
    return $result;

}




/**
* Esta funcion se encarga de obtener un objeto effect
*/
function KTT_get_ajax_animation_effect($id) {

    /**
    * Obtenemos la lista de tempaltes
    */
    $effects = KTT_get_ajax_animations_effects();

    /**
    * Devolvemos la template cuya id coincida con la que tenemos
    */
    $effect = @$effects[$id];

    /**
    * Devolvemos la template
    */
    return $effect;

}




/**
* Esta funcion se encarga de devolver la lista completa de templates disponibles en el theme
*/
function KTT_get_ajax_animations_effects() {

    /**
    * En result vamos a ir formando la salida
    */
    $result = array();

    /**
    * Obtenemos la lista de template files
    */
    $files = KTT_get_ajax_animations_effects_files();

    /**
    * Si no tenemos templates salimos de aqui
    */
    if (!$files) return $result;

    /**
    * Itineramos por cada uno de los templates y los añadimos al array result
    */
    foreach($files as $file) {

        /**
        * Añadimos los datos de la template al array
        */
        $data = KTT_get_ajax_animation_effect_data($file);
        $result[$data->id] = $data;

    }

    /**
    * Devovolvemos la lista
    */
    return $result;

}





 ?>
