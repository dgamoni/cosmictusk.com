<?php
/**
 * template for comments
 *
 */



$disqus_shortname = get_option(ktt_var_name('disqus_shortname'));
$disqus_disable_mobile = get_option(ktt_var_name('disqus_disable_mobile'));

?>




<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_shortname = '<?php echo $disqus_shortname;?>';
    var disqus_identifier = '<?php echo $post->ID;?>';
    var disqus_title = '<?php echo esc_html($post->post_title);?>';
    var disqus_url = '<?php echo get_permalink($post->ID);?>';
    <?php if ($disqus_disable_mobile) {?>var disqus_disable_mobile = true;<?php } ?>
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>

