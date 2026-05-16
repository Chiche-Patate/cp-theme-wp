<?php
add_action('admin_menu', function () {
    add_menu_page(
        'Options',
        'Options',
        'edit_pages',
        'options',
        'render_options',
        'dashicons-admin-generic',
        60
    );
});

// =============================================================================
// Configuration des sections et champs
// Pour ajouter une section : ajouter un bloc dans $sections
// Pour ajouter un champ : ajouter un élément dans 'fields' de la section
// Types disponibles : text, wysiwyg
// =============================================================================
function get_options_config() {
    return [
        // -------------------------
        // Section : Teaser Footer
        // -------------------------
        'teaser_footer' => [
            'title'  => 'Teaser Footer',
            'fields' => [
                'teaser_footer_title' => [
                    'label' => 'Titre',
                    'type'  => 'text',
                ],
                'teaser_footer_subtitle' => [
                    'label' => 'Sous-titre',
                    'type'  => 'text',
                ],
                'teaser_footer_content' => [
                    'label' => 'Contenu',
                    'type'  => 'wysiwyg',
                ],
                'teaser_footer_btn_text' => [
                    'label' => 'Texte du bouton',
                    'type'  => 'text',
                ],
                'teaser_footer_btn_url' => [
                    'label' => 'Lien du bouton',
                    'type'  => 'text',
                ],
            ],
        ],
    ];
}

// =============================================================================
// Enregistrement automatique des sections et champs
// =============================================================================
add_action('admin_init', function () {
    foreach (get_options_config() as $section_id => $section) {
        add_settings_section(
            "options_section_{$section_id}",
            $section['title'],
            null,
            'options'
        );

        foreach ($section['fields'] as $field_id => $field) {
            add_settings_field(
                $field_id,
                $field['label'],
                'render_options_field',
                'options',
                "options_section_{$section_id}",
                [
                    'field_id' => $field_id,
                    'type'     => $field['type'],
                ]
            );
        }
    }
});

// =============================================================================
// Sauvegarde via admin_post
// =============================================================================
add_action('admin_post_save_options', function () {
    if (!check_admin_referer('options_save', 'options_nonce')) {
        wp_die('Sécurité : nonce invalide.');
    }

    if (!current_user_can('edit_pages')) {
        wp_die('Accès refusé.');
    }

    $data    = $_POST['options'] ?? [];
    $options = get_option('options', []);

    foreach (get_options_config() as $section) {
        foreach ($section['fields'] as $field_id => $field) {
            if (!isset($data[$field_id])) continue;

            $options[$field_id] = $field['type'] === 'wysiwyg'
                ? wp_kses_post($data[$field_id])
                : sanitize_text_field($data[$field_id]);
        }
    }

    update_option('options', $options);

    wp_redirect(add_query_arg([
        'page'    => 'options',
        'updated' => 'true',
    ], admin_url('admin.php')));
    exit;
});

// =============================================================================
// Rendu des champs
// =============================================================================
function render_options_field($args) {
    $options  = get_option('options');
    $field_id = $args['field_id'];
    $value    = $options[$field_id] ?? '';

    switch ($args['type']) {
        case 'wysiwyg':
            wp_editor($value, "{$field_id}_editor", [
                'textarea_name' => "options[{$field_id}]",
                'textarea_rows' => 8,
                'teeny'         => true,
                'media_buttons' => false,
                'quicktags'     => true,
            ]);
            break;

        case 'text':
        default:
            echo '<input
                type="text"
                id="' . esc_attr($field_id) . '"
                name="options[' . esc_attr($field_id) . ']"
                value="' . esc_attr($value) . '"
                class="regular-text"
            />';
            break;
    }
}

// =============================================================================
// Rendu de la page
// =============================================================================
function render_options() {
    if (isset($_GET['updated'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Options enregistrées.</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Options</h1>
        <form method="post" action="<?= esc_url(admin_url('admin-post.php')) ?>">
            <?php
            wp_nonce_field('options_save', 'options_nonce');
            ?>
            <input type="hidden" name="action" value="save_options">
            <?php
            do_settings_sections('options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}