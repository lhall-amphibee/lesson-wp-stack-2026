<?php

namespace EventsManager;
class PostType
{
    const POST_TYPE = 'evenement';

    public function register() {
        add_action('init', [ $this, 'register_evenement_post_type' ]);
    }

    public function register_evenement_post_type()
    {
        $labels = array(
            'name'                  => 'Évènements',
            'singular_name'         => 'Évènement',
            'menu_name'            => 'Évènements',
            'add_new'              => 'Ajouter un évènement',
            'add_new_item'         => 'Ajouter un nouvel évènement',
            'edit_item'            => 'Modifier l\'évènement',
            'new_item'             => 'Nouvel évènement',
            'view_item'            => 'Voir l\'évènement',
            'search_items'         => 'Rechercher des évènements',
            'not_found'            => 'Aucun évènement trouvé',
            'not_found_in_trash'   => 'Aucun évènement trouvé dans la corbeille',
            'all_items'            => 'Tous les évènements',
            'archives'             => 'Archives des évènements',
        );

        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'show_in_rest'        => true, // Enable Gutenberg editor
            'menu_icon'           => 'dashicons-calendar-alt',
            'hierarchical'        => false,
            'supports'            => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
                'custom-fields'
            ),
            'has_archive'         => true,
            'rewrite'             => array(
                'slug' => 'evenements'
            ),
            'menu_position'       => 5,
        );

        register_post_type( self::POST_TYPE, $args);
    }
}