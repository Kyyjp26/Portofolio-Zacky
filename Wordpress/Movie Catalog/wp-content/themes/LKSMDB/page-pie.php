<?php
get_header();
?>
<div class="container py-4">
    <h2>Chart Genre</h2>
    <div class="flex jc-center"><?php echo do_shortcode('[genre-posts-count-chart]') ?></div>
</div>
<?php
get_footer();
