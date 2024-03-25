<?php
/**
* Enable angularjs in the site/theme
*/



/**
* Esta funcion se encarga de devolver true si angularjs esta activo en el subtitilo
*/
function KTT_is_angularjs_active() {
    return true;
}



/**
* Esta funcion se encarga de añadir los atributos necesarios a la etiqueta body
* para poder funcionar con angularjs
*/
function KTT_set_angularjs_body_attrs($result) {

    /**
    * Devolvemos los atributos del body mas los que vamos a añadir para angularjs
    */
    return $result .= ' ' . 'ng-app="main_app" ng-controller="main_app_controller"';

}
if (KTT_is_angularjs_active()) add_filter('KTT_body_attrs', 'KTT_set_angularjs_body_attrs', 1 );






/**
* Con este hook nos aseguramos de añadir al footer del sitio el codigo necesario para
* activar angularjs (aqui va la app)
*/
function KTT_add_angularjs_app() {

  ?>
  <script>

  	/**
  	* Controller de main_app
    * TODO: Filtro de libs
  	*/
  	
  	main_app.controller('main_app_controller',  function($scope, $compile, $http, $q, $timeout, $mdSidenav, $document) {
  	//main_app.controller('main_app_controller',  function($scope, $compile, $http, $q, $timeout, $mdSidenav, $location, $anchorScroll) {


    
    
        //$scope.gotoBottom = function() {
          //$location.hash('comments-container');
          //$anchorScroll();
        //};
  	      	<?php
  	      	/**
  	      	* Este hook lo utilizaremos para añadir funciones adicionales a la app principal
  	      	* del sitio desde modulos exteriores
  	      	*/
  	      	do_action('THEME_angularjs_main_app');
  	      	?>


  	});

        
    		

    		
    	
  </script>
  <?php

}
add_action('KTT_theme_body_end', 'KTT_add_angularjs_app', 5);







?>
