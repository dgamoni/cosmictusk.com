
/**
* Definimos la applicacion global que vamos a usar en la web y que se llama en el body de la pagina
*/


var main_app = angular.module('main_app', ['ngMaterial'], ['duScroll']);



/**
* configuracion general de la app
*/
/*
main_app.config(function($mdThemingProvider) {
  $mdThemingProvider.theme('default')
    .primaryPalette('blue-grey')
    .accentPalette('indigo');

});
*/

main_app.config(['$compileProvider', function ($compileProvider) {
    $compileProvider.debugInfoEnabled(false);
}]);


