<?php

/**
* Esta funcion que encarga de interceptar el hook de la app en angular para
* añadir el codigo necesario para hacer funcionar el sidenav del sitio
*/
function KTT_site_angularjs_sidenav() {

  ?>
  $scope.open_left_sidenav = function() {;

        var container = jQuery( '#site-wrap' );
        overlay = jQuery( '#site-menu-block' );

        if( overlay.hasClass('open') ) {

              overlay.removeClass('open');
              container.removeClass('overlay-open');
              overlay.addClass('close');

        } else {

              overlay.addClass( 'open' );
              container.addClass( 'overlay-open' );
              overlay.removeClass('close');

        }


  }



  <?php

}
add_action("THEME_angularjs_main_app", "KTT_site_angularjs_sidenav", 5);
 ?>
