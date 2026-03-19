<?php

add_action( 'wp_enqueue_scripts', 'enqueue_child_styles');
function enqueue_child_styles() {
    wp_enqueue_style( 'events-style', get_stylesheet_directory_uri() . '/style.css' );
}

// ── Block Styles ────────────────────────────────────────────────────────────
//
// register_block_style() ajoute une variation de style sur un bloc natif.
// Elle apparaît dans la sidebar de l'éditeur, sous "Styles".
//
// Paramètres :
//   1. $block_name  — nom du bloc cible (ex: 'core/quote')
//   2. $style_props — tableau avec :
//        'name'  → slug CSS (sera appliqué comme classe "is-style-{name}")
//        'label' → libellé affiché dans l'éditeur
//
// Le CSS correspondant est à écrire dans style.css sur la classe :
//   .wp-block-quote.is-style-mise-en-avant { ... }
//
add_action( 'init', function() {
    register_block_style(
        'core/quote',
        [
            'name'  => 'mise-en-avant',
            'label' => __( 'Mise en avant', 'events-manager' ),
        ]
    );
} );

// Charge style.css aussi dans l'éditeur Gutenberg
// Sans ça, les block styles ne sont visibles qu'en frontend.
add_action( 'after_setup_theme', function() {
    add_editor_style( 'style.css' );
} );























add_action('init', function() {
    add_theme_support('acf-blocks');
});

// functions.php
add_action('init', function() {
    register_block_pattern_category('custom-patterns', [
        'label' => __('Custom Patterns', 'events-manager')
    ]);

    register_block_pattern('events-manager/custom-content', [
        'title' => __('Custom Content', 'events-manager'),
        'categories' => ['custom-patterns'],
        'content' => '<!-- wp:group -->
                     <div class="wp-block-group">
                         <!-- wp:html -->
                         <?php
                         if (function_exists("get_field")) {
                             get_template_part("template-parts/content", "custom");
                         }
                         ?>
                         <!-- /wp:html -->
                     </div>
                     <!-- /wp:group -->'
    ]);
});

