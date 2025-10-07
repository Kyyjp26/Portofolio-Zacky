<?php
/*
PLugin Name: Genre Pie Chart
Description: Menampilkan pie chart jumlah post per genre dengan shortcode
Version: 1.0
Author: JeckDev
*/

if (!defined('ABSPATH')) {
    exit;
}

function genre_pie_chart_enqueue_scripts()
{
    wp_enqueue_script('chartjs', 'https://cdn.jsdelivr.net/npm/chart.js', [], null, true);

    wp_enqueue_script(
        'pie-script',
        plugin_dir_url(__FILE__) . 'script.js',
        ['chartjs'],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'genre_pie_chart_enqueue_scripts');

function genre_pie_chart_shortcode()
{
    $genres = get_terms([
        'taxonomy' => 'genre',
        'hide_empty' => true
    ]);

    if (is_wp_error($genres) || empty($genres)) {
        return '<p>No genre found</p>';
    }

    $labels = [];
    $data = [];

    foreach ($genres as $genre) {
        $labels[] = $genre->name;
        $data[] = $genre->count;
    }

    $chartId = 'genrePieChart_' . uniqid();

    wp_localize_script('pie-script', 'genrePieChartData', [
        'chartId' => $chartId,
        'labels' => $labels,
        'data' => $data
    ]);

    ob_start();
?>
    <canvas class="chart" id="<?php echo esc_attr($chartId) ?>"></canvas>
<?php
    return ob_get_clean();
}
add_shortcode('genre-posts-count-chart', 'genre_pie_chart_shortcode');
