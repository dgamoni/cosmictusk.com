<?php
/**
 * Ajax Navigation Support
 * version 1.3
 */

/*
HOOKS ---------------------------------------------------------------


do_action('KTT_theme_ajax_load_content_before');
Se ejecuta justo antes de que comience la request para cargar contenido de la url
Es util para preparar las animaciones antes de la carga


do_action('KTT_theme_ajax_load_content_success');
Se ejecuta cuando la carga de contenido de una url ha ocurrido con exito


do_action('KTT_theme_ajax_load_content_error');
Se ejecuta cuando ha ocurrido un error tratando de cargar una url


do_action('KTT_theme_ajax_load_content_finally');
Se ejecuta cuando se ha terminado de cargar una url, indistintamente del resultado
Es util para terminar animaciones



FILTERS --------------------------------------------------------------

apply_filters('KTT_theme_ajax_template_parts', $result);
Este filtro lo utilizaremos para añadir elementos al array de partes ajax
Este array es el que indica que partes del html debemos actualizar con ajax

*/








/**
* Devuelve true si tenemos habilitado ajax en el sitio
*/
function KTT_ajax_is_enabled() {
		return get_option(ktt_var_name('active_ajax_navigation'));
}



/**
* Esta funcion se encarga de devolver un array que indica las partes html
* del theme que deben actualizarse con ajax.
* FORMATO:
 array(
		'selector' => '#selector',
		'content' => ''
)
*/
function KTT_get_theme_ajax_template_parts() {

		$result = array();

		/**
		* Gracias a este filter podemos añadir elementos desde terceras partes
		*/
		$result = apply_filters('KTT_theme_ajax_template_parts', $result);

		/**
		* Devovlemos el array resultante
		*/
		return $result;

}




/**
* Este hook hace que podamos cambiar la url del browser sin actualizar el contenido
*/
function KTT_update_browser_url() {

		?>
		history.pushState({}, url, url);
		<?php

}
add_action('KTT_theme_ajax_load_content_success', 'KTT_update_browser_url');



/**
* Esta funcion se encarga de añadir todo el codigo necesario para hacer funcionar
* la navegacion ajax en el sitio
* do_action('KTT_after_ajax_link_load')
* do_action('KTT_before_ajax_link_load')
*/
function KTT_ajax_js() {

	if (!KTT_ajax_is_enabled()) return;
	?>

	/**
	* Esta funcion se encarga de hacer funcionar los botones de pagina
	* anterior del navegador
	*/
	window.onpopstate = function(event) {
		if(event.state !== null) {
			//$scope.load_ajax_url(location.href);
			window.location.replace(location.href);
		}
	}

	/**
	* Definimos los divs que buscamos actualizar
	*/
	$scope.parts_to_update = <?php echo json_encode(KTT_get_theme_ajax_template_parts(), JSON_PRETTY_PRINT) ?>;;

	/**
	* En esta variable guardamos el html que vamos a utilizar
	*/
	$scope.current_html;

	/**
	* Capturamos los links del documento
	*/
	$scope.get_links = function() {

				/**
				* Obtenemos los links
				*/
				var links = angular.element('a');

				/**
				* Devolvemos los links
				*/
				return links;
	}

	/**
	* Esta funcion se encarga de actualizar el head de la pagina
	*/
	$scope.update_page_head = function() {

				var regExp = /<head[^>]*>([\s\S]*)<\/head>/gi;
				var matches = regExp.exec($scope.current_html);
				var head = matches[1];

				/**
				* Obtenemos el head nuevo
				*/
				var new_head = angular.element(head);

				/**
				* Obtenemos el head actual de la pagina
				*/
				var current_head = jQuery('head').html();











				/**
				*	Obtenemos los elementos actuales en el header
				*/
				var current_elements = jQuery('head > *');

				/**
				* Itineramos por cada uno de los elementos actuales del footer y eliminamos
				* aquellos que tengan innerhtml
				*/
				current_elements.each(function(){

						/**
						* Todos los elements que sean title o meta debemos eliminarlos
						*/
						if(this.tagName == 'TITLE') this.remove();
						if(this.tagName == 'META') this.remove();
						//if(this.tagName == 'STYLE') this.remove();

				});











				/**
				* TODO: Eliminamos del current head elementos que sabemos que se deben
				* actualizar, tales como el title, el feed o los links prev y next
				*/

				/**
				* Vamos a itinerar por cada uno de los elementos del head de la nueva
				* pagina y vamos a ir añadiendo a la actual solo los elemtnso nuevos
				*/
				angular.forEach(new_head, function(elem) {

						/**
						* Si el elemento que estamos manejando ya aparece en el
						* current head entonces no hacemos nada con else
						*/
						if (elem.outerHTML) if (current_head.indexOf(elem.outerHTML) < 0) {

								//console.log(elem.outerHTML)
							 jQuery('head').append($compile(elem)($scope));
						}

				});

				//jQuery("head").html($compile(head)($scope));

	}



	$scope.update_page_footer = function() {

				/**
				*	Obtenemos los elementos actuales en el footer
				*/
				var current_elements = jQuery('#wp_footer_wrap > *');

				/**
				* Itineramos por cada uno de los elementos actuales del footer y eliminamos
				* aquellos que tengan innerhtml
				*/
				current_elements.each(function(){
						//if(this.innerHTML) this.remove();
				});



				var data = $scope.current_html;
				jQuery('<div/>').html(data).find('#wp_footer_wrap').map(function() {

					var x = angular.element(this.innerHTML);
					angular.forEach(x, function(elem) {

						if (elem.innerHTML) {

						}

					})

		    }).get();




	}


	/**
	* Esta funcion recibe un data con codigo html y trata de devolver solo
	* el contenido en el div que le pasemos como parametro
	*/
	$scope.get_data_div_content = function (selector, data) {

				/**
				* Obtenemos el html
				*/
				var result = jQuery("<div>" + data + "</div>").find(selector).html(); //angular.element(data).filter('.container').html();

				/**
				* Compilamos el html para que se inicien bien las directivas
				* y demas mierdecicas de angularjs
				*/
				var compiled = $compile(result)($scope);

				/**
				* Devolvemos el html compilado
				*/
				return compiled;

	}



	/**
	* Esta funcion se encarga de cargar una url en una variable y devolverla
	*/
	$scope.load_url_content = function(url) {

				/**
				* En esta variable guardamos lo que va a ser la respuesta de la función
				* false si da error o un attach_id si ha sido exitosa.
				*/
				var result = false;

				/**
				* Creamos un objeto deferred que será el que nos ayude a manejar la promise.
				*/
				var defer = $q.defer();

				/**
				* Este action nos sirve para ejecutar código antes de que empiece a ejecutase
				* la funcion que conecta con la url y extrae el contenido
				*/
				<?php do_action('KTT_theme_ajax_load_content_before');?>

				/**
				* Realizamos la llamada http
				*/
				var request = $http({
	            method: "get",
	            url:  url
	      });

	      /**
				* Si la llamada ha sido exitosa...
				*/
				request.then(function(response) {

						/**
						* Actualizamos el codigo current
						*/
						$scope.current_html = response.data;

						/**
						* Este action nos sirve para ejecutar código en el momento en el que
						* la request finaliza con exito
						*/
						<?php do_action('KTT_theme_ajax_load_content_success');?>

						/**
						* En caso de exito la llamada devuelve un array que contiene el store_item y store_order
						* Que son las ids del item recien creado y del pedido al que corresponde
						*/
						result = response.data;

	      });

	      /**
	      * Chequeamos si ha ocurrido un error
	      */
	      request.catch(function(response) {

						/**
						* Este action nos sirve para ejecutar código en el momento en el que
						* la request finaliza con error
						*/
						<?php do_action('KTT_theme_ajax_load_content_error');?>

						/**
						* Devolvemos el mensaje de error
						*/
						//alert(response.data['message']);

	      });

	      /**
	      * Acciones que deben realizarse una vez terminada la llamada
	      */
	      request.finally(function() {

						/**
						* Este action nos sirve para ejecutar código en el momento en el que
						* la request finaliza ( ya sea satisfactoriamente o note)
						*/
						<?php do_action('KTT_theme_ajax_load_content_finally');?>


						/**
		         * En el defer definimos el resultado de esta funcion
		        */
		        if (result) defer.resolve(result)
		        else defer.reject(result);

				});

				/**
				* devolvemos la premise
				*/
				return defer.promise;

	}



	/**
	* Esta funcion se encarga de añadir a un link el bind para funcionar con ajax
	*/
	$scope.add_ajax_to_link = function(link_object) {

			/**
			* Obtenemos el elemento DOM con sus atributos
			*/
			link_object = angular.element(link_object);

			/**
			* Le añadimos el binding
			*/
			link_object.unbind("click").bind('click', function(e) {

					/**
					* Si estamos ante una url valida entonces vamos a añadirle el bind que
					* la transformará en un link ajax
					*/
					if ($scope.link_is_ajax_friendly(link_object)) {

								/**
								* Prevenimos al link de seguir adelante la carga
								*/
								e.preventDefault();

								/**
								* Capturamos la url
								*/
								var url = link_object.context.attributes.href.value;

								/**
								* Cargamos la url con ajax
								*/
								$scope.load_ajax_url(url);

					}

			});

	}


	/**
	* Esta funcion se encarga de cargar una url ajax y realizar todo lo necesario
	* para actualizar la pagina segun lo hayamos configurado
	*/
	$scope.load_ajax_url = function(url) {

			/**
			* Contactamos con la url para obtener su contenido.
			*/
			var ajax_request = $scope.load_url_content(url);

			/**
			* En caso de éxito...
			*/
			ajax_request.then(function(data){

						/**
						* Actualiamos el header
						*/
						$scope.update_page_head();
						$scope.update_page_footer();

						/**
						* Obtenemos el contenido html de los divs que nos interesan
						*/
						$scope.parse_html_contents(data);

						/**
						* Actualizamos los divs
						*/
						$scope.update_ajax_parts();

						/**
						* Hacemos que los links nuevos tambien sean ajax
						*/
						$scope.convert_links_to_ajax();

						/**
						* Este action nos sirve para ejecutar código antes de que empiece a ejecutase
						* la funcion que conecta con la url y extrae el contenido
						*/
						<?php do_action('KTT_theme_ajax_load_content_after');?>


						//window.wp.customHeader.initialize.bind( window.wp.customHeader );
						//window.wp.customHeader.initialize();


			});

	}



	/**
	* Esta función se encarga de obtener del codigo html el contenido de los divs que estamos
	* buscando actualizar.
	*/
	$scope.parse_html_contents = function(html) {

			/**
			* Itineramos por cada uno de los divs que estamos buscando
			*/
			angular.forEach($scope.parts_to_update, function(part) {

					/**
					* Actualizamos su content con el contenido que hayamos obtenido
					* del html.
					*/
					part.content = $scope.get_data_div_content(part.selector, html);

			});

	}



	/**
	* Esta función se encarga de actualizar el contenido de las partes ajax
	*/
	$scope.update_ajax_parts = function() {

			/**
			* Itineramos por cada uno de los divs que estamos buscando
			*/
			angular.forEach($scope.parts_to_update, function(part) {

					/**
					* Añadimos el código compilado al div
					*/
					if (Object.keys(part.content).length > 1) jQuery(part.selector).html(part.content);

			});

	}


	/**
	* Esta funcion se encarga de evaluar si una url es valida para usar ajax
	* No debemos transformar en link ajax los que vaya a una url externa
	*/
	$scope.link_is_ajax_friendly = function(link_element) {

			/**
			* Si el hostname del elemento casa con nuestra url actual entonces devolvemos
			* true puesto que es un link interno
			*/
			if (window.location.hostname === link_element.context.hostname || !link_element.context.hostname.length ) {

					/**
					* Antes de devolver un true vamos a comprobar que no se trate de una url de administracion
					* en tal caso debemos devolver false;
					*/
					if (link_element.context.href.indexOf('wp-admin') != -1) return false;

					/**
					* Debemos comprobar si en la terminacion de la url existe una extension
					* de archivo
					*/
					if (link_element.context.href.split('.').pop().length < 5) return false;

					/**
					* Si hemos pasado los filtros devolvemos true;
					*/
					return true;
					
			}

			/**
			* Si hemos llegado hasta aqui es porque no hemos podido validar la url del elemento como
			* una url interna que sea apta para cargar con AJAX, por lo tanto devolvemos un false
			* y salimos de la funcion
			*/
			return false;

	}



	/**
	* Esta funcion se encarga de buscar los links en el html y convertirlos
	* a ajax magicamente
	*/
	$scope.convert_links_to_ajax = function() {
		var links = $scope.get_links();
		angular.forEach(links, function(link) {
				$scope.add_ajax_to_link(link);
		});
	}


	$scope.convert_links_to_ajax();



	<?php
}
add_action('THEME_angularjs_main_app', 'KTT_ajax_js');

















// add page to theme options

//$args = array();
//$args['panel_id'] 						= ktt_var_name('customize-typography');
//$args['panel_title'] 					= __('Fonts & Typography',THEME_TEXTDOMAIN);
//$args['panel_description'] 		= __("Customize the theme's typography related elements.", THEME_TEXTDOMAIN);
//$args['panel_priority'] 			= 1;
//new KTT_new_customize_panel($args);





/**
* Una seccion nos ayuda a organizar los elementos de la pagina
*/

$args                           	= array();
$args['section_id']              	= ktt_var_name('ajax-navigation');
$args['section_title']            = __('AJAX Navigation', THEME_TEXTDOMAIN);
$args['section_description']     	= sprintf(__('AJAX Navigation can be activated with just one click to accelerate and approach the navigation throughout %s.', THEME_TEXTDOMAIN), get_bloginfo('name'));
//$args['section_panel']            = ktt_var_name('customize-typography');
new KTT_new_customize_section($args);







// add option to admin panel

$args                           = array();
$args['option_id']              = ktt_var_name('active_ajax_navigation');
$args['option_name']           	= __('AJAX Navigation', THEME_TEXTDOMAIN);
$args['option_description']     = __('Active dynamic navigation in the site.', THEME_TEXTDOMAIN);
$args['option_priority'] 				= 40;
$args['option_type']            = 'checkbox';
$args['option_type_vars']				= array(
																	'selector' => '.site-typeface-title',
																	'font_family' => true,
																	'font_size' => false,
																	);
$args['option_default'] 				= 1;
$args['option_section']    			= ktt_var_name('ajax-navigation');
new KTT_new_customize_setting($args);




?>
