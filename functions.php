<?php
/**
 * Chargement des assets via le manifest Vite
 */
add_action('wp_enqueue_scripts', function () {
    $manifest_path = get_theme_file_path('dist/.vite/manifest.json');

    if (!file_exists($manifest_path)) return;

    $manifest = json_decode(file_get_contents($manifest_path), true);
    $entry    = $manifest['src/scripts/main.js'] ?? null;

    if (!$entry) return;

    $dist_uri = get_theme_file_uri('dist');

    if (!empty($entry['css'])) {
        foreach ($entry['css'] as $css_file) {
            wp_enqueue_style(
                'theme-css-' . basename($css_file),
                $dist_uri . '/' . $css_file,
                [],
                null
            );
        }
    }

    wp_enqueue_script(
        'theme-js',
        $dist_uri . '/' . $entry['file'],
        [],
        null,
        true
    );
});

wp_localize_script('theme-js', 'theme', [
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce'    => wp_create_nonce('theme_nonce'),
]);

/**
 * Support du thème
 */
add_action('after_setup_theme', function () {
    register_nav_menu('primary', __('Header', 'theme'));
    register_nav_menu('secondary', __('Footer', 'theme'));
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
});

/**
 * Excerpt
 */
add_filter('excerpt_length', function () {
    return 20;
});

add_filter('excerpt_more', function () {
    return '...';
});