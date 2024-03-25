<?php


/**
* Mediante este script añadimos toda la configuración del theme necesaria para incluir
* todos los archivos php necesarios
*/
foreach (glob(dirname(__FILE__) . "/*", GLOB_ONLYDIR) as $filename) {
		include($filename . '/' . basename($filename) . '.php');
};
?>
