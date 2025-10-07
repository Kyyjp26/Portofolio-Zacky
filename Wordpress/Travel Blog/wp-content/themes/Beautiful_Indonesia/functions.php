<?php
function lks22_enqueue_assets()
{
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/css/style.css');

    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/js/script.js', [], false, true);
}
add_action('wp_enqueue_scripts', 'lks22_enqueue_assets');

function lks22_custom_post_type()
{
    function labels($singular, $plural = "")
    {
        if (empty($plural)) {
            $plural = $singular . 's';
        }

        return [
            'name' => $plural,
            'singular_name' => $singular,
            'search_items' => 'Search ' . $plural,
            'all_items' => 'All ' . $plural,
            'parent_item' => 'Parent ' . $singular,
            'parent_item_colon' => 'Parent ' . $singular . ':',
            'edit_item' => 'Edit ' . $singular,
            'update_item' => 'Update ' . $singular,
            'add_new_item' => 'Add New ' . $singular,
            'new_item' => 'New ' . $singular,
            'menu_name' => $plural,
        ];
    }

    register_post_type('place', [
        'labels' => labels('Place'),
        'supports' => ['title', 'editor', 'thumbnail'],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'places'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-location-alt',
    ]);

    register_post_type('article', [
        'labels' => labels('Article'),
        'supports' => ['title', 'editor', 'thumbnail'],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'article', 'with_front' => false],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-admin-post',
    ]);

    register_taxonomy('category', ['article'], [
        'labels' => labels('Category', 'Categories'),
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'categories'],
        'show_admin_column' => true,
        'show_ui' => true,
        'query_var' => true,
    ]);
}
add_action('init', 'lks22_custom_post_type');
