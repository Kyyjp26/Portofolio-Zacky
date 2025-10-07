<?php
/*
Plugin Name: Social Media
Description: Menambahkan tautan media sosial yang tampil di footer.
Version: 1.1
Author: JeckDev
*/

if (!defined('ABSPATH')) exit;

// 1. Tambahkan menu admin
function sm_add_admin_menu()
{
    add_menu_page(
        'Social Media',
        'Social Media',
        'manage_options',
        'sm-social-media',
        'sm_admin_page',
        'dashicons-share',
        20
    );
}
add_action('admin_menu', 'sm_add_admin_menu');

// 2. Halaman pengaturan
function sm_admin_page()
{
?>
    <div class="wrap">
        <h1>Social Media Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('sm_settings_group');
            do_settings_sections('sm-settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

// 3. Registrasi setting
function sm_register_settings()
{
    register_setting('sm_settings_group', 'sm_social_links', 'sm_sanitize_links');

    add_settings_section(
        'sm_section',
        'Tambahkan Link Media Sosial',
        null,
        'sm-settings'
    );

    add_settings_field(
        'sm_links',
        'Link Sosial Media',
        'sm_links_fields_html',
        'sm-settings',
        'sm_section'
    );
}
add_action('admin_init', 'sm_register_settings');

// 4. HTML input untuk field
function sm_links_fields_html()
{
    $links = get_option('sm_social_links', []);

    if (!is_array($links)) {
        $links = [];
    }

    echo '<div id="sm-links-wrapper">';
    foreach ($links as $index => $link) {
        echo '<div class="sm-link-row" style="margin-bottom:10px">';
        echo '<input type="text" name="sm_social_links[' . $index . '][name]" value="' . esc_attr($link['name']) . '" placeholder="Name" required />';
        echo ' <input type="url" name="sm_social_links[' . $index . '][url]" value="' . esc_url($link['url']) . '" placeholder="https://example.com" required />';
        echo '</div>';
    }
    echo '</div>';

    echo '<button type="button" onclick="addSocialLinkRow()">+ Tambah Link</button>';

    echo <<<HTML
    <script>
        function addSocialLinkRow() {
            const wrapper = document.getElementById('sm-links-wrapper');
            const index = wrapper.children.length;
            const div = document.createElement('div');
            div.className = 'sm-link-row';
            div.style.marginBottom = '10px';
            div.innerHTML = `
                <input type="text" name="sm_social_links[\${index}][name]" placeholder="Name" required />
                <input type="url" name="sm_social_links[\${index}][url]" placeholder="https://example.com" required />
            `;
            wrapper.appendChild(div);
        }
    </script>
    HTML;
}

// 5. Sanitasi data input
function sm_sanitize_links($input)
{
    $output = [];
    foreach ($input as $link) {
        if (!empty($link['name']) && !empty($link['url'])) {
            $output[] = [
                'name' => sanitize_text_field($link['name']),
                'url'  => esc_url_raw($link['url']),
            ];
        }
    }
    return $output;
}

// 6. Tampilkan di footer
function sm_show_links_in_footer()
{
    $links = get_option('sm_social_links', []);
    if (empty($links)) return;

    echo '<div class="footer-container" id="footer-container">';
    echo '<div class="sm-footer container">';
    echo '<p>Copyright © ' . date('Y') . ' All rights reserved:</p>';
    echo '<div class="footer-list">';
    foreach ($links as $link) {
        echo '<a style="margin: 0 10px;" href="' . esc_url($link['url']) . '" target="_blank" rel="noopener">' . esc_html($link['name']) . '</a>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
add_action('wp_footer', 'sm_show_links_in_footer');
