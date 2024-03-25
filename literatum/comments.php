<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 */



/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

	<?php
	$comments_template_path = 'comments-wordpress.php';
	if ( function_exists('KTT_get_comments_template_path') ) $comments_template_path = KTT_get_comments_template_path();
	include($comments_template_path);
	?>
