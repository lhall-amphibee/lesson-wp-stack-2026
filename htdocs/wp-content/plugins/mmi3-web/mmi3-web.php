<?php
/**
 * Plugin Name: MMI3 Web
 * Plugin URI:  https://example.com/mmi3-web
 * Description: A custom plugin for MMI3 Web.
 * Version:     1.0.0
 * Author:      MMI3
 * Author URI:  https://example.com
 * License:     GPL-2.0-or-later
 * Text Domain: mmi3-web
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the "Evenement" custom post type.
 */
function mmi3_web_register_evenement_cpt() {
    $labels = [
        'name'                  => __( 'Événements', 'mmi3-web' ),
        'singular_name'         => __( 'Événement', 'mmi3-web' ),
        'add_new'               => __( 'Ajouter', 'mmi3-web' ),
        'add_new_item'          => __( 'Ajouter un événement', 'mmi3-web' ),
        'edit_item'             => __( 'Modifier l\'événement', 'mmi3-web' ),
        'new_item'              => __( 'Nouvel événement', 'mmi3-web' ),
        'view_item'             => __( 'Voir l\'événement', 'mmi3-web' ),
        'search_items'          => __( 'Rechercher des événements', 'mmi3-web' ),
        'not_found'             => __( 'Aucun événement trouvé', 'mmi3-web' ),
        'not_found_in_trash'    => __( 'Aucun événement dans la corbeille', 'mmi3-web' ),
        'all_items'             => __( 'Tous les événements', 'mmi3-web' ),
        'archives'              => __( 'Archives des événements', 'mmi3-web' ),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'rewrite'            => [ 'slug' => 'evenements' ],
    ];

    register_post_type( 'evenement', $args );
}
add_action( 'init', 'mmi3_web_register_evenement_cpt' );

/**
 * Register the "Thème" taxonomy for Evenement.
 */
function mmi3_web_register_theme_taxonomy() {
    $labels = [
        'name'              => __( 'Thèmes', 'mmi3-web' ),
        'singular_name'     => __( 'Thème', 'mmi3-web' ),
        'search_items'      => __( 'Rechercher des thèmes', 'mmi3-web' ),
        'all_items'         => __( 'Tous les thèmes', 'mmi3-web' ),
        'edit_item'         => __( 'Modifier le thème', 'mmi3-web' ),
        'update_item'       => __( 'Mettre à jour le thème', 'mmi3-web' ),
        'add_new_item'      => __( 'Ajouter un thème', 'mmi3-web' ),
        'new_item_name'     => __( 'Nouveau thème', 'mmi3-web' ),
        'not_found'         => __( 'Aucun thème trouvé', 'mmi3-web' ),
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'theme-evenement' ],
    ];

    register_taxonomy( 'theme_evenement', [ 'evenement' ], $args );
}
add_action( 'init', 'mmi3_web_register_theme_taxonomy' );