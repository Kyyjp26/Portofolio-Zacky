<?php
get_header();
?>
<div class="container py-4">
    <div class="mb-4">
        <h2 class="mb-4">Top Movies</h2>
        <div class="grid-container">
            <?php
            $shows = new WP_Query([
                'posts_per_page' => 4,
                'post_type' => 'show',
                'meta_key' => 'like_count',
                'orderby' => 'meta_value_num',
                'order' => 'DESC'
            ]);

            if ($shows->have_posts()) {
                while ($shows->have_posts()) {
                    $shows->the_post(); ?>
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
            }
            ?>
        </div>
    </div>
    <div>
        <h2 class="mb-4">All Movies</h2>
        <div class="grid-container">
            <?php
            $shows = new WP_Query([
                'posts_per_page' => -1,
                'post_type' => 'show',
            ]);

            if ($shows->have_posts()) {
                while ($shows->have_posts()) {
                    $shows->the_post(); ?>
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
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
