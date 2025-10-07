<?php
function lksmdb_enqueue_assets()
{
    // CSS
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/assets/css/style.css');

    // JavaScript
    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/assets/js/script.js', [], false, true);


    // Ajax
    wp_localize_script('child-script', 'lksmdb_data', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'lksmdb_enqueue_assets');


function register_custom_post_type()
{
    function labels($singular, $plural = '')
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
            'new_item_name' => 'New ' . $singular . ' Name',
            'menu_name' => $plural
        ];
    }

    register_post_type('show', [
        'supports' => ['title', 'editor', 'thumbnail', 'comments'],
        'labels' => labels('Show'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'show'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-video-alt2'
    ]);

    register_post_type('cast', [
        'supports' => ['title', 'editor', 'thumbnail',],
        'labels' => labels('Cast'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'cast'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-groups'
    ]);

    register_taxonomy('genre', ['show'], [
        'labels' => labels('Genre'),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'genre'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'register_custom_post_type');

function handle_increase_like_count()
{
    $postId = intval($_POST['post_id']);
    if (!$postId) {
        wp_send_json_error(['message' => 'invalid id']);
    }

    $likeCount = get_field('like_count', $postId);
    $likeCount++;
    update_field('like_count', $likeCount, $postId);

    wp_send_json_success(['new_count' => $likeCount]);
}
add_action('wp_ajax_increase_like_count', 'handle_increase_like_count');
add_action('wp_ajax_nopriv_increase_like_count', 'handle_increase_like_count');

function redirect_auth_custom()
{
    if (basename($_SERVER['REQUEST_URI']) === 'wp-login.php' && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $login_page = home_url('/login/');
        wp_redirect($login_page);
        exit;
    }

    if (
        strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false &&
        isset($_GET['action']) && $_GET['action'] === 'register'
    ) {
        $register_page = home_url('/register/');
        wp_redirect($register_page);
        exit;
    }
}

add_action('init', 'redirect_auth_custom');
