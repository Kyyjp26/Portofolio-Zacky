<?php
get_header();
?>
<div class="container py-4">
    <div>
        <h2 class="mb-4">Genre: <?php single_term_title() ?></h2>
        <div class="grid-container">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post(); ?>
                    <div class="card">
                        <a href="<?php esc_url(the_permalink()) ?>">
                            <?php
                            if (has_post_thumbnail()) { ?>
                                <img src="<?php esc_url(the_post_thumbnail_url('medium')); ?>" alt="<?php esc_attr(the_title()) ?>" class="card-img" />
                            <?php
                            }
                            ?>
                        </a>
                        <div>
                            <a href="<?php esc_url(the_permalink()) ?>">
                                <h3><?php esc_html(the_title()) ?></h3>
                            </a>
                            <p>Release Date: <?php echo esc_html(get_field('release_date')) ?></p>
                        </div>
                    </div>
                <?php
                }
                wp_reset_postdata();
            } else { ?>
                <p>No show found from this genre</p>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer()
?>