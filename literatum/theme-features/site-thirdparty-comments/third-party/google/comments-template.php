<?php
/**
 * template for comments
 *
 */


$facebook_comments_load_number = get_option(ktt_var_name('facebook_comments_load_number'));
$facebook_comments_order = get_option(ktt_var_name('facebook_comments_order'));
$permalink = get_permalink();
?>

<script src="https://apis.google.com/js/plusone.js"></script>
<div id="google-comments">
</div>

<script>
gapi.comments.render('google-comments', {
    href: '<?php echo $permalink;?>',
    width: '640',
    first_party_property: 'BLOGGER',
    view_type: 'FILTERED_POSTMOD'
});
</script>



