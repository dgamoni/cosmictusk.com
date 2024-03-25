<?php
/*
Effect Name: Spill
Scripts Dependencies: snap.svg-min, svgLoader
CSS Dependencies: ajax-transitions-base
*/




/**
* Esta animacion se ejecuta justo antes de que se carge la pagina
*/
function KTT_ajax_preload_effect_animation() {

  ?>
  loader.show();
  jQuery('#site-wrap').fadeToggle("normal", function() {

  });
  <?php

}
add_action('KTT_theme_ajax_load_content_before', 'KTT_ajax_preload_effect_animation');







/**
* Esta animacion se ejecuta cuando la carga ha terminado
*/
function KTT_ajax_finally_effect_animation() {

  ?>

  jQuery('#site-wrap').fadeToggle("fast", function() {
    loader.hide();
  });

  <?php

}
add_action('KTT_theme_ajax_load_content_after', 'KTT_ajax_finally_effect_animation');







/**
* Este hook se encarga de añadir el html necesario al inicio de la etiqueta body
*/
function KTT_ajax_body_html() {

  ?>
  <div id="loader" class="pageload-overlay"  data-opening="M 0,0 c 0,0 63.5,-16.5 80,0 16.5,16.5 0,60 0,60 L 0,60 Z">
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
      <path d="M 0,0 c 0,0 -16.5,43.5 0,60 16.5,16.5 80,0 80,0 L 0,60 Z"/>
    </svg>
  </div>
  <?php

}
add_action('KTT_theme_body_start', 'KTT_ajax_body_html', 5);
