<?php
/**
* Functions template system
*/


/**
* Esta funcion se encarga de extraer la lista de templates files
* Esta funcion solo obtiene un array con rutas de archivo
*/
function KTT_get_theme_templates_files() {

    /**
    * Vamos a ir guardando las templates que encontremos en este array
    */
    $result = array();

    /**
    * Itineramos por cada una de las templates de categoria que encontremos
    */
    foreach (glob(get_template_directory() . "/template-*.php") as $filename) $result[] = $filename;

    /**
    * Devolvemos el array con los resultados
    */
    return $result;

}



/**
* Esta funcion obtiene los datos de tuna template en un object
*/
function KTT_get_theme_template_data($file_path) {

    /**
    * En la variable result vamos guardando el resultados
    */
    $result = new stdClass();

    /**
    * Cremos un identificador unico para la template
    */
    $template_id = basename($file_path);

    /**
    * Obtenemos la data de la template leyendo los primeros bytes del file
    */
    $args = array(
      'name' => 'Template Name',
      'types' => 'Template Post Type',
      'styles' => 'Template Styles'
    );
    $source = get_file_data($file_path, $args);

    /**
    * Guardamos los datos en el array de salida
    */
    $result->id = $template_id;
    $result->name = $source['name'];
    $result->types = str_replace(' ', '', explode(',',$source['types']));
    $result->styles = str_replace(' ', '', explode(',',$source['styles']));
    $result->path = $file_path;

    /**
    * Como bonus vamos a añadir tambien las opciones de configuracion
    * de la template
    */
    //$result->options = KTT_get_template_options($template_id);

    /**
    * Devolvemos el resultado
    */
    return $result;

}




/**
* Esta opcion se encarga de devolver una lista de opciones relacionadas
* con la template cuya id se indique
*/
function KTT_get_template_options($template_id) {

    global $wpdb;

    /**
    * En result vamos a ir formando el array de opciones que esta funcion
    * debe devolver
    */
    $result = array();

    /**
    * Definimos el identificador de variables de la template
    */
    $template_id_option_name = ktt_var_name('template_' . $template_id . '_option_');

    /**
    * Creamos una request que trate de obtener todas las opciones en la bbdd
    * que estan relacionadas con la template_id
    */
    $options = $wpdb->get_results("Select * FROM {$wpdb->options} WHERE option_name LIKE '{$template_id_option_name}%'");

    /**
    * Si hemos encontrado opciones vamos a añadirlo al array correctamente formateadas
    */
    //if ($options) foreach ($options as $option) $result[str_replace($template_id_option_name, '', $option->option_name)] = maybe_unserialize($option->option_value);
    if ($options) foreach ($options as $option) $result[str_replace($template_id_option_name, '', $option->option_name)] = get_option($option->option_name);

    /**
    * Por ultimo devolvemos el array de opciones
    */
    return $result;

}






/**
* Esta funcion se encarga de obtener un objeto theme template en base a un id
*/
function KTT_get_theme_template($id) {

    /**
    * Obtenemos la lista de tempaltes
    */
    $templates = KTT_get_theme_templates();

    /**
    * Devolvemos la template cuya id coincida con la que tenemos
    */
    $template = @$templates[$id];

    /**
    * Devolvemos la template
    */
    return $template;

}


/**
* Esta funcion se encarga de devolver la lista completa de templates disponibles en el theme
*/
function KTT_get_theme_templates() {

    /**
    * En result vamos a ir formando la salida
    */
    $result = array();

    /**
    * Obtenemos la lista de template files
    */
    $files = KTT_get_theme_templates_files();

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
        $data = KTT_get_theme_template_data($file);
        $result[$data->id] = $data;

    }

    /**
    * Devovolvemos la lista
    */
    return $result;

}


/**
* Esta funcion extrae un array con todas las templates disponibles para el type que
* se introduzca como parametro
*/
function KTT_get_theme_templates_by_type($type) {

    /**
    * Definimos el array resultante
    */
    $result = array();

    /**
    * Extraemos todas las templates
    */
    $templates = KTT_get_theme_templates();

    /**
    * Si no hay templates salimos de aqui
    */
    if (!$templates) return;

    /**
    * Itineramos por cada tempalte y la añadimos al resultado si es Devuelve
    * type que buscamos
    */
    foreach ($templates as $template) if (in_array($type, $template->types)) $result[$template->id] = $template;

    /**
    * Devolvemos el resultado
    */
    return $result;

}


/**
* Esta funcion se encarga de obtener la template de la pagina actual
*/
function KTT_get_current_theme_template() {

    $result = '';

    if (is_single() || is_page()) $result = KTT_get_post_template();
    if ($result) return $result;

    if (is_author()) $result = KTT_get_user_template();
    if ($result) return $result;

    if (is_tag()) $result = KTT_get_post_tag_template();
    if ($result) return $result;

    if (is_category()) $result = KTT_get_category_template();
    if ($result) return $result;

    if (is_archive()) $result = KTT_get_archive_template();
    if ($result) return $result;

    if (is_search()) $result = KTT_get_search_template();
    if ($result) return $result;

    $result = KTT_get_frontpage_posts_template();

    return $result;


}
