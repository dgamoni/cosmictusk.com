<?php


/**
* Devuelve true si la funcion de contar palabras esta activa
*/
function KTT_post_display_read_time_is_active() {
	return get_option(ktt_var_name('post_show_read_time'));
}


/**
* Devuelve el número de palabras que hay en el contenido de un post que se
* pase como parametro
*/
function KTT_get_post_words_count($post) {

    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    /**
    * Obtenemos el content del Post
    */
    $content = get_post_field( 'post_content', @$post->ID );

    /**
    * Contamos las palabras que tiene el contenido
    */
    $result = str_word_count( strip_tags( $content ) );

    /**
    * Devolvemos el resultado
    */
    return $result;

}


/**
* Esta funcion se encarga de calcular el tiempo de lectura en base al numero de palabras
*/
function KTT_get_post_read_time($post) {

    if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    /**
    * Obtenemos el número de palabras
    */
    $words = KTT_get_post_words_count($post);

    /**
    * Definimos la media de palabras que se pueden leer en un segundo
    */
    $words_per_second = 3;

    /**
    * Calculamos el tiempo en minutos
    */
    $result = round(($words / $words_per_second) / 60);

    /**
    * Si es un 0 lo transformamos en un 1
    */
    if (!$result) return 1;

    /**
    * Devolvemos el resultado
    */
    return $result;

}


/**
* Esta funcion se encarga de mostrar el read time de un Post
*/
function KTT_display_post_read_time($post = '') {

	if (!$post) global $post;
	if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

	/**
	* Obtenemos el tipo de readtime que esta configurado
	*/
	$read_time_type 	= get_option(ktt_var_name('post_read_time_type'));

	if ($read_time_type == 'words_count') {
		echo KTT_get_post_words_count($post);
	} else {
		echo KTT_get_post_read_time($post);
	}

}


/**
* Esta funcion se encarga de devolver el title formated de un post
*/
function KTT_get_post_title_formated($post = '') {

    if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);
    if (!$post) global $post;

    /**
    * Si encontramos definido en el post el titulo formateado lo Devolvemos
    */
    if (isset($post->post_title_formated) && $post->post_title_formated) return $post->post_title_formated;

    /**
    * Si hemos llegado hasta aqui significa que el post no tiene un titulo formateado,
    * por lo tanto devolvemos el titulo normal
    */
    return $post->post_title;
}


/**
* Esta funcion se encarga de devolver el title formated de un post
*/
function KTT_get_post_subtitle_formated($post = '') {

		if (!$post) global $post;
    if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

    /**
    * Si encontramos definido en el post el subtitulo formateado lo Devolvemos
    */
    if (isset($post->post_subtitle_formated) && $post->post_subtitle_formated) return $post->post_subtitle_formated;

    /**
    * Si no tiene subtitulo formateado vamos a probrar si ruviera un subtitulo normal
    */
    if (isset($post->post_subtitle) && $post->post_subtitle) return $post->post_subtitle;


    /**
    * Si hemos llegado hasta aqui devolvemos un false
    */
    return false;
}



/**
* Esta funcion se encarga de obtener solo la id de la template que esta usando un post
*/
function KTT_get_post_template_id($post) {

		if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

		/**
		* Intentamos obtener la id de template que tiene vinculada el post si la hubiere
		*/
		$template_id = '';
		if (isset($post->post_template)) $template_id = $post->post_template;
		if (!$template_id) if (isset($post->page_template)) $template_id = $post->page_template;
		if ($template_id == 'default') $template_id = '';

		/**
		* Si no hemos encontrado ninguna template vinculada buscamos si el theme tiene definida
		* alguna en sus opciones para los posts
		*/
		if (!$template_id && is_single()) $template_id = KTT_get_theme_option('post_template');
		if (!$template_id && is_page()) $template_id = KTT_get_theme_option('page_template');

		/**
		* Si a estas alturas no tenemos template id vamos a obtener la lista de
		* todas las templates para los posts y nos quedamos con la primera que encontremos
		*/
		if (!$template_id) {

				/**
				* Obtenemos la lista de templates disponibles para un post
				*/
				if (is_single()) $templates = KTT_get_theme_templates_by_type('post');
				if (is_page()) $templates = KTT_get_theme_templates_by_type('page');

				/**
				* Nos quedamos con la primera de la lista
				*/
				if ($templates) $template_id = array_values($templates)[0]->id;

		}

		/**
		* Devolvemos la template id
		*/
		return $template_id;


}


/**
* Esta funcion se encarga de obtener la template que le corresponde a un post
*/
function KTT_get_post_template($post = '') {

		if (!$post) global $post;
		if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

		/**
		* Obtenemos la lista de templates disponibles para un post
		*/
		if (is_single()) $templates = KTT_get_theme_templates_by_type('post');
		if (is_page()) $templates = KTT_get_theme_templates_by_type('page');

		/**
		* Si no hay templates salimos de aqui
		*/
		if (!$templates) return;

		/**
		* Intentamos obtener la id de template que tiene vinculada el post si la hubiere
		*/
		$template_id = KTT_get_post_template_id($post);

		/**
		* Si tenemos id pero resulta que dicha id no se encuentra entre la lista de
		* templates disponibles buscamos la que esta configurada por defecto
		** para todos los posts
		*/
		if (!isset($templates[$template_id]) && is_single()) $template_id = KTT_get_theme_option('post_template');
		if (!isset($templates[$template_id]) && is_page()) $template_id = KTT_get_theme_option('page_template');

		/**
		* Devolvemos el objeto template
		*/
		return $templates[$template_id];

}



/**
* Esta función se encarga de mostrar en nuestra plantilla la lista de tags pertenecientes a
* un post
*/
function KTT_post_display_html_tags($post) {

	if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

	/**
	* Obtenemos los tags del post
	*/
	$posttags = get_the_tags($post->ID);
	if ($posttags) foreach($posttags as $tag) {
			?>
			<a
			class="icon-tag site-typeface-body margin-right-10 margin-bottom-5 display-inline-block link-chip typo-size-xsmall border-radius-2 padding-top-5 padding-bottom-5 padding-left-10 padding-right-10"
			ng-href="<?php echo get_tag_link($tag);?>">
				<?php echo $tag->name;?>
			</a>
			<?php
	}

}


/**
* Muestra el subtitulo del sitio
*/
function KTT_get_the_subtitle($post = '') {

		if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

		/**
		* Si no se ha indicado un post intentamos obtener el current
		*/
		if (!$post) {
			global $post;
			$post = KTT_get_post($post->ID);
		}

		/**
		* Devolvemos el subtitle
		*/
		if (isset($post->post_subtitle_formated) && $post->post_subtitle_formated) return $post->post_subtitle_formated;
		if (isset($post->post_subtitle)) return $post->post_subtitle;

}

/**
* Esta funcion muestra directamente el subtitle
*/
function KTT_the_subtitle($post = '') {
		echo KTT_get_the_subtitle($post);
}






/**
* Muestra el subtitulo del sitio
*/
function KTT_get_the_title($post = '') {

		if ($post) if (is_int($post) || is_string($post)) $post = KTT_get_post($post);

		/**
		* Si no se ha indicado un post intentamos obtener el current
		*/
		if (!$post) {
			global $post;
			$post = KTT_get_post($post->ID);
		}

		$result = $post->post_title_formated;
		if (!$result) $result = $post->post_title;

		/**
		* Devolvemos el subtitle
		*/
		return $result;

}

/**
* Esta funcion muestra directamente el subtitle
*/
function KTT_the_title($post = '') {
		echo KTT_get_the_title($post);
}

?>
