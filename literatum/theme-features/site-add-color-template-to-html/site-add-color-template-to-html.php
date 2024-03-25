<?php
/**
* Gracias a este script podemos atribuirle una o varias clases al elemento body
*/
function KTT_add_color_template_to_html($classes) {

        $template_id = get_option(ktt_var_name('site_color_template'), 'default');
        $template_class = 'color-template-' . $template_id;

        /**
        * Añadimos la clase que define a la plantilla de color
        */
        $classes[] = $template_class;

        /**
        * Devolvemos el array de fuentes modificado
        */
        return $classes;
}
add_filter('html_class', 'KTT_add_color_template_to_html');


 ?>
