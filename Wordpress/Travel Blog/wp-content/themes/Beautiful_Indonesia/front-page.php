<?php
get_header()
?>

<div class="hero-container">
    <?php
    echo do_shortcode('[smartslider3 slider="2"]');
    ?>
</div>

<div class="container py-5">
    <div class="about-section mb-5">
        <div class="about-image">
            <img src="<?php echo esc_attr(get_stylesheet_directory_uri() . '/images/bali.jpg') ?>" alt="About">
        </div>
        <div class="about-content">
            <h2 class="section-title mb-3">About Us</h2>
            <p class="section-description">Beautiful Indonesia is a platform dedicated to showcasing the rich culture, stunning landscapes, and vibrant traditions of Indonesia. Join us in exploring the beauty of this archipelago.</p>
        </div>
    </div>
    <div class="">
        <h2 class="text-center mb-4">Best Places</h2>
        <?php
        $places = new WP_Query([
            'post_type' => 'place',
            'posts_per_page' => 4,
            'meta_key' => 'view_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
        ]);

        if ($places->have_posts()) { ?>
            <div class="grid-container">
                <?php
                while ($places->have_posts()) {
                    $places->the_post(); ?>

                    <div class="card">
                        <a href="<?php esc_url(the_permalink()) ?>">
                            <?php
                            if (has_post_thumbnail()) { ?>
                                <div class="card-image">
                                    <img src="<?php esc_url(the_post_thumbnail_url('medium')) ?>" alt="<?php esc_attr(the_title()) ?>">
                                    <button class="btn btn-warning">Visit</button>
                                </div>
                            <?php
                            }
                            ?>
                        </a>
                        <div class="card-body">
                            <h3><?php esc_html(the_title()) ?></h3>
                            <p><?php esc_html(the_excerpt()) ?></p>
                        </div>
                    </div>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
get_footer();
?>