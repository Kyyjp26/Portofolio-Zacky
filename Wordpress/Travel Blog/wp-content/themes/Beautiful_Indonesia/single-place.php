<?php
get_header();

$placeId = get_the_ID();
$viewCount = get_field('view_count', $placeId);
$viewCount++;
update_field('view_count', $viewCount, $placeId);
?>

<div class="container py-4">
    <div class="detail-container mb-2">
        <?php
        if (has_post_thumbnail()) { ?>
            <div class="detail-image">
                <img src="<?php esc_url(the_post_thumbnail_url('medium')) ?>" alt="<?php esc_attr(the_title()) ?>">
            </div>
        <?php
        }
        ?>
        <div class="detail-content">
            <h2><?php esc_html(the_title()) ?></h2>
            <p>View Count: <?php echo esc_html($viewCount) ?></p>
            <?php esc_html(the_excerpt()) ?>
        </div>
    </div>
    <div>
        <h2 class="mb-2">Gallery</h2>
        <?php
        $galleries = get_field('gallery');
        if ($galleries) { ?>
            <div class="gallery-container">
                <?php
                foreach ($galleries as $gallery) { ?>
                    <img src="<?php echo esc_url($gallery['sizes']['medium']) ?>" alt="<?php echo esc_attr($gallery['alt']) ?>">
                <?php
                }
                ?>
            </div>
        <?php
        } else { ?>
            <p>No gallery available for this place.</p>
        <?php }
        ?>
    </div>
</div>

<?php
get_footer();
?>