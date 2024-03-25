<?php
/**
* Este script se encarga de añadir una topbar a nuestro sitio que utilizaremos
* como ayuda de interfaz para la navegacion general en la web, aquí podrán integrarse
* elementos de navegación y logos, ayudas, entonces
*/



/**
* Esta funcion se encarga de añadir el html necesario para el pushmenu en el inicio
* de la etiqueta body
*/
function KTT_add_thme_push_menu_html() {

    ?>
    <div class="container">
    <div class="mp-pusher " id="mp-pusher">


            <!-- /mp-menu -->

            <nav id="mp-menu" class="mp-menu site-palette-yin-1-background-color site-palette-yang-1-color">
    					<div class="mp-level">

    						<div id="sidebar-content">

    							<?php dynamic_sidebar( 'main-sidebar-area' ); ?>

    						</div>



    						<footer id="colophon" class="site-footer" role="contentinfo">
    							<div class="site-info default-content-width">
    								<div class="int">

    									<?php $website_firm = get_option(ktt_var_name('website_firm'));
    									if ($website_firm) {?>
    									<div class="footer-firm typo-size-xsmall">
    										<?php echo $website_firm;?>
    									</div>
    									<?php } ?>



    									<?php if ( has_nav_menu( 'bottom-menu' ) ) {?>
    									<div class="bottom-menu-container" style="text-align:right">
    											<?php wp_nav_menu( array( 'theme_location' => 'bottom-menu', 'menu_class' => 'bottom-menu display-inline',  )); ;?>
    									</div>
    									<?php } ?>

    									<div style="clear:both"></div>

    								</div>
    							</div><!-- .site-info -->
    						</footer><!-- #colophon -->






    					</div>
    				</nav>


            <div class="scroller " ><!-- this is for emulating position fixed of the nav -->
    	      <div class="scroller-inner " style="overflow-y: auto;">
              <div class="push-cover" onclick="pushmenu();"></div>
    <?php

}
add_action('KTT_theme_body_start', 'KTT_add_thme_push_menu_html', 5);



/**
* Esta funcion se encarga de añadir el html necesario para el pushmenu en el inicio
* de la etiqueta body
*/
function KTT_add_thme_push_menu_html_close() {

    ?>
      </div><!-- /scroller-inner -->
      </div><!-- /scroller -->
      </div><!-- /pusher -->
      </div><!-- /container -->

      <script>
      function pushmenu() {
        if (jQuery('#mp-menu, .scroller').hasClass('cbp-spmenu-push-toright')) {
            jQuery('#mp-menu, .scroller').removeClass('cbp-spmenu-push-toright');
        } else {
            jQuery('#mp-menu, .scroller').addClass('cbp-spmenu-push-toright');
        }
      }
      </script>
    <?php

}
add_action('KTT_theme_body_end', 'KTT_add_thme_push_menu_html_close', 1);






/**
* Si la navegacion ajax esta activa tenemos que añadir un pequeño fix para ocultar el menu cada vez
* que se cargue una nueva pagina si el menu esta visible
*/
function KTT_add_theme_fullscreen_menu_ajax_navigation_fix() {

  // javascript
  ?>
    jQuery('#mp-menu, .scroller').removeClass('cbp-spmenu-push-toright');
  <?php

}
if (KTT_ajax_is_enabled()) add_action('KTT_theme_ajax_load_content_finally', 'KTT_add_theme_fullscreen_menu_ajax_navigation_fix');
