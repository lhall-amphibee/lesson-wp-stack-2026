<?php

use EventsManager\PostType;

$categories  = get_terms([
    'taxonomy'   => 'categorie-evenement',
    'hide_empty' => false,
]);

$current_category   = isset($_GET['categorie-evenement']) ? sanitize_text_field($_GET['categorie-evenement']) : '';
$current_event_type = isset($_GET['event_type']) ? sanitize_text_field($_GET['event_type']) : '';
$archive_url        = get_post_type_archive_link(PostType::POST_TYPE);
?>

<form class="events-filters" method="get" action="<?php echo esc_url($archive_url); ?>">

    <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
        <div class="events-filters__group">
            <label for="filter-categorie" class="events-filters__label">
                <?php esc_html_e('Catégorie', 'events-manager'); ?>
            </label>
            <select id="filter-categorie" name="categorie-evenement" class="events-filters__select">
                <option value=""><?php esc_html_e('Toutes les catégories', 'events-manager'); ?></option>
                <?php foreach ($categories as $term) : ?>
                    <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current_category, $term->slug); ?>>
                        <?php echo esc_html($term->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <div class="events-filters__group">
        <label for="filter-event-type" class="events-filters__label">
            <?php esc_html_e('Type d\'évènement', 'events-manager'); ?>
        </label>
        <select id="filter-event-type" name="event_type" class="events-filters__select">
            <option value=""><?php esc_html_e('Tous les types', 'events-manager'); ?></option>
            <option value="free" <?php selected($current_event_type, 'free'); ?>>
                <?php esc_html_e('Gratuit', 'events-manager'); ?>
            </option>
            <option value="paid" <?php selected($current_event_type, 'paid'); ?>>
                <?php esc_html_e('Payant', 'events-manager'); ?>
            </option>
        </select>
    </div>

    <div class="events-filters__actions">
        <button type="submit" class="events-filters__submit">
            <?php esc_html_e('Filtrer', 'events-manager'); ?>
        </button>

        <?php if ($current_category || $current_event_type) : ?>
            <a href="<?php echo esc_url($archive_url); ?>" class="events-filters__reset">
                <?php esc_html_e('Réinitialiser', 'events-manager'); ?>
            </a>
        <?php endif; ?>
    </div>

</form>
