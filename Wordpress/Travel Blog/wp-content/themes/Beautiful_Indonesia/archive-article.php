<?php
get_header();
?>

<div class="container py-4">
    <h2 class="mb-4">All Articles</h2>
    <?php
    $articles = new WP_Query([
        'post_type' => 'article',
        'posts_per_page' => -1,
    ]);

    if ($articles->have_posts()) { ?>
        <div class="grid-container">
            <?php
            while ($articles->have_posts()) {
                $articles->the_post(); ?>

                <div class="card">
                    <div class="card-header">
                        <h4><?php esc_html_e(get_the_author()); ?></h4>
                        <p>Date: <?php esc_html_e(get_the_date()); ?></p>
                    </div>
                    <div class="card-body">
                        <a href="<?php esc_url(the_permalink()) ?>">
                            <h3 class="mb-2"><?php esc_html(the_title()) ?></h3>
                        </a>
                        <?php esc_html(the_excerpt()) ?>
                        <div class="flex gap-2 mt-2">
                            <p>Categories:</p>
                            <?php
                            $categories = get_the_category();
                            wp_list_categories([
                                'include' => wp_list_pluck($categories, 'term_id'),
                                'style' => 'none',
                                'separator' => '',
                                'title_li' => ', ',
                            ]);
                            ?>
                        </div>
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

<?php
get_footer();
?>