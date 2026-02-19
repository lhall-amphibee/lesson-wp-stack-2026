<?php

namespace EventsManager;

class Taxonomies
{
    public function register()
    {
        add_action('init', array($this, 'register_taxonomies'));
    }

    public function register_taxonomies(): void
    {
        $labels = array(
            'name'              => 'Catégories',
            'singular_name'     => 'Catégorie',
            'search_items'      => 'Rechercher des catégories',
            'all_items'         => 'Toutes les catégories',
            'parent_item'       => 'Catégorie parente',
            'parent_item_colon' => 'Catégorie parente:',
            'edit_item'         => 'Modifier la catégorie',
            'update_item'       => 'Mettre à jour la catégorie',
            'add_new_item'      => 'Ajouter une nouvelle catégorie',
            'new_item_name'     => 'Nom de la nouvelle catégorie',
            'menu_name'         => 'Catégories',
        );

        $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'           => true,
            'show_ui'          => true,
            'show_admin_column' => true,
            'show_in_rest'     => true,
            'rewrite'          => array(
                'slug' => 'categorie-evenement'
            ),
        );

        register_taxonomy('categorie-evenement', PostType::POST_TYPE, $args);
    }
}