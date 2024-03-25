<?php
/**
 * facebook comments support
 *
 */



// form options for admin panel
include('form.php');

// functions for facebook
if (KTT_get_comments_system() == 'google') include('hooks&functions.php');

?>