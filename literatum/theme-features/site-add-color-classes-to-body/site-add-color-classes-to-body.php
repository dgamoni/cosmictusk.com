<?php

/**
* Gracias a este script podemos atribuirle una o varias clases al elemento body
*/
function KTT_add_color_class_to_body($classes) {

        /***
        * Esta clase define el color de fondo
        */
        $classes[] = 'site-palette-yang-1-background-color';

        /**
        * Esta clase define el color de fuentes
        */
        $classes[] = 'site-palette-yin-1-color';

        /**
        * Ya de paso añadimos la clase que define la typeface que usaremos
        * por defecto en el body
        */
        $classes[] = 'site-typeface-body';

        /**
        * Devolvemos el array de fuentes modificado
        */
        return $classes;
}
add_filter('body_class', 'KTT_add_color_class_to_body');

 ?>
