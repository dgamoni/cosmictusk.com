<?php
/*
Effect Name: Top Loading Bar
Scripts Dependencies:
CSS Dependencies: ajax-transitions-base
*/




/**
* Esta animacion se ejecuta justo antes de que se carge la pagina
*/
function KTT_ajax_preload_effect_animation() {

  ?>
  jQuery('#loader').fadeIn();
  <?php

}
add_action('KTT_theme_ajax_load_content_before', 'KTT_ajax_preload_effect_animation');







/**
* Esta animacion se ejecuta cuando la carga ha terminado
*/
function KTT_ajax_finally_effect_animation() {

  ?>
  jQuery('#loader').fadeOut('normal', function() {});
  <?php

}
add_action('KTT_theme_ajax_load_content_after', 'KTT_ajax_finally_effect_animation');







/**
* Este hook se encarga de añadir el html necesario al inicio de la etiqueta body
*/
function KTT_ajax_body_html() {

  ?>
  <div id="loader" class="pageload-overlay show" style="display:none;background-color:rgba(255,255,255, 0.5)">
    <md-progress-linear class="md-hue-1" md-mode="indeterminate"></md-progress-linear>
  </div>
  <?php

}
add_action('KTT_theme_body_start', 'KTT_ajax_body_html', 5);
