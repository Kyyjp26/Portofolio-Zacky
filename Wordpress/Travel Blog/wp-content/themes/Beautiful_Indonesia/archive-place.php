<?php
get_header();

$sort_val = isset($_GET['sort']) ? $_GET['sort'] : '';
?>

<div class="container py-4">
    <h2 class="mb-4">All Places</h2>

    <!-- Dropdown for sorting -->
    <form method="get" class="mb-4">
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="date" <?php selected($sort_val, 'date'); ?>>Date Created</option>
            <option value="title" <?php selected($sort_val, 'title'); ?>>Name</option>
            <option value="view_count" <?php selected($sort_val, 'view_count'); ?>>View Count</option>
        </select>
    </form>

    <?php
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'date';

    $args = [
        'post_type' => 'place',
        'posts_per_page' => -1,
    ];

    switch ($sort) {
        case 'view_count':
            $args['meta_key'] = 'view_count';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'title':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'date':
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }

    $places = new WP_Query($args);

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

<?php
get_footer();
?>