<?php
get_header();
?>

<div class="container py-4">
    <div class="detail-container mb-2">
        <div class="detail-content">
            <h2><?php esc_html(the_title()) ?></h2>
            <?php esc_html(the_excerpt()) ?>
            <div class="flex gap-2">
                <p>Caterories: </p>
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
</div>

<?php
get_footer();
?>