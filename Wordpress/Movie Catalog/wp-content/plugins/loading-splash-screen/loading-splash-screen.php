<?php
/*
PLugin Name: Loading Splash Screen
Description: Menampilkan loading splash screen
Version: 1.0
Author: JeckDev
*/

function loading_splash_screen_assets()
{
    wp_enqueue_style(
        'loading-style',
        plugin_dir_url(__FILE__) . 'style.css'
    );

    wp_enqueue_script(
        'loading-script',
        plugin_dir_url(__FILE__) . 'script.js',
        [],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'loading_splash_screen_assets');

function lssa_loading_html()
{ ?>
    <div id="lssa-loader">
        <div class="spinner"></div>
    </div>
<?php
}
add_action('wp_footer', 'lssa_loading_html');
