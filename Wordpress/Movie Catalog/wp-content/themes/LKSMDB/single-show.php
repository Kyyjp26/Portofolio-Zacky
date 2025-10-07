<?php
get_header();

$post_id = get_the_ID();
$viewCount = get_field('view_count', $post_id);
$viewCount++;
update_field('view_count', $viewCount, $post_id)

?>
<div class="container py-4">
    <div class="mb-4">
        <div class="card flex card-show">
            <?php
            if (has_post_thumbnail()) { ?>
                <img src="<?php esc_url(the_post_thumbnail_url('medium')); ?>" alt="<?php esc_attr(the_title()) ?>" class="card-img" style="max-width: 20rem;" />
            <?php
            }
            ?>
            <div class="container">
                <h2 class="mb-2"><?php esc_html(the_title()) ?></h2>
                <div class="flex ai-center gap-3 mb-2">
                    <p>Rating: <?php echo esc_html(get_field('average_rating')) ?></p>
                    <p>View Count: <?php echo esc_html(get_field('view_count')) ?></p>
                    <div class="flex ai-center gap-2">
                        <p>Like: <span id="like-count"><?php echo esc_html(get_field('like_count')) ?></span></p>
                        <button id="like-button" data-post-id="<?php echo get_the_ID() ?>" class="btn btn-danger">Like</button>
                    </div>
                </div>
                <div class="mb-2">
                    <h3 class="mb-1">Synopsis</h3>
                    <p><?php echo esc_html(get_field('synopsys')) ?></p>
                </div>
                <div class="mb-2">
                    <h3 class="mb-1">Release Date</h3>
                    <p><?php echo esc_html(get_field('release_date')) ?></p>
                </div>
                <div class="mb-2">
                    <h3 class="mb-1">Genres</h3>
                    <?php
                    $genres = get_the_terms(get_the_ID(), 'genre');
                    if ($genres) {
                        $genre_links = array_map(function ($genre) {
                            return '<a href="' . esc_url(get_term_link($genre)) . '">' . esc_html($genre->name) . '</a>';
                        }, $genres);
                        echo '<p>' . implode(', ', $genre_links) . '</p>';
                    } else { ?>
                        <p>No genre found from this show</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <?php
        $casts = get_field('casts');

        if ($casts) { ?>
            <h2 class="mb-4">Cast</h2>
            <div class="grid-container">
                <?php
                foreach ($casts as $cast) {
                    setup_postdata($cast);
                ?>
                    <div class="card">
                        <?php
                        $cast_thumb = get_the_post_thumbnail_url($cast->ID, 'medium');
                        if ($cast_thumb) { ?>
                            <img src="<?php echo esc_url($cast_thumb); ?>" alt="<?php echo esc_attr(get_the_title($cast->ID)) ?>" class="card-img" />
                        <?php
                        }
                        ?>
                        <div>
                            <h3><?php echo esc_attr(get_the_title($cast->ID)) ?></h3>
                            <p><?php echo esc_attr(get_the_excerpt($cast->ID)) ?></p>
                        </div>
                    </div>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        <?php
        } else { ?>
            <p>No cast found for this show</p>
        <?php
        }
        ?>
    </div>
    <div class="mb-4">
        <h2 class="mb-4">Gallery</h2>
        <div class="gallery-container">
            <?php
            $galleries = get_field('photo_gallery');

            if ($galleries) {
                foreach ($galleries as $gallery) { ?>
                    <div class="">
                        <img src="<?php echo  esc_url($gallery['sizes']['medium']); ?>" alt="<?php echo esc_attr($gallery['alt']) ?>" class="card-img" />
                    </div>
                <?php
                }
            } else { ?>
                <p>No gallery found for this show</p>
            <?php
            }
            ?>
        </div>
    </div>

    <?php comments_template() ?>
</div>
<?php
get_footer();
