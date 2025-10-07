<?php
get_header();

// Filter Sort
$sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'date';
$genre = isset($_GET['genre']) ? sanitize_text_field($_GET['genre']) : '';

$args = [
    'posts_per_page' => -1,
    'post_type' => 'show',
];

if ($genre) {
    $args['tax_query']  = [
        [
            'taxonomy' => 'genre',
            'field' => 'slug',
            'terms' => $genre
        ]
    ];
}

switch ($sort) {
    case 'view_count':
        $args['meta_key'] = 'view_count';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        break;
    case 'like_count':
        $args['meta_key'] = 'like_count';
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
}

$genres = get_terms([
    'taxonomy' => 'genre',
    'hide_empty' => false
])

?>
<div class="container py-4">
    <div>
        <div class="flex jc-between mb-2 header-show">
            <h2>All Movies</h2>
            <form method="GET" class="flex gap-2 ai-center">
                <div>
                    <label for="sort">Sort by:</label>
                    <select name="sort" id="sort">
                        <option value="date" <?php selected($sort, 'date') ?>>Created Date</option>
                        <option value="view_count" <?php selected($sort, 'view_count') ?>>View Count</option>
                        <option value="like_count" <?php selected($sort, 'like_count') ?>>Like Count</option>
                        <option value="title" <?php selected($sort, 'title') ?>>Title</option>
                    </select>
                </div>
                <div>
                    <label for="genre">Genre:</label>
                    <select name="genre" id="genre">
                        <option value="">All Genre</option>
                        <?php foreach ($genres as $genre_item) { ?>
                            <option value="<?php echo esc_attr($genre_item->slug); ?>"
                                <?php selected($genre, $genre_item->slug); ?>>
                                <?php echo esc_html($genre_item->name); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-primary">Filter</button>
            </form>
        </div>
        <div class="grid-container">
            <?php
            $shows = new WP_Query($args);

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
?>