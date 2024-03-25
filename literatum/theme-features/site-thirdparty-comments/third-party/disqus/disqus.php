<?php
/**
 * disqus support
 *
 */



// form options for admin panel
include('form.php');

// functions for disqus
if (KTT_get_comments_system() == 'disqus') include('hooks&functions.php');

?>