<?php

namespace EventsManager;

class Archive
{
    private bool $is_evenement_archive = false;
    private bool $injected = false;

    public function register(): void
    {
        add_action('pre_get_posts', [$this, 'filter_archive_query']);
        add_filter('render_block', [$this, 'inject_filter_template'], 10, 2);
    }

    public function filter_archive_query(\WP_Query $query): void
    {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        if (!$query->is_post_type_archive(PostType::POST_TYPE)) {
            return;
        }

        $this->is_evenement_archive = true;

        $category = isset($_GET['categorie-evenement']) ? sanitize_text_field($_GET['categorie-evenement']) : '';
        if ($category) {
            $query->set('tax_query', [
                [
                    'taxonomy' => 'categorie-evenement',
                    'field'    => 'slug',
                    'terms'    => $category,
                ],
            ]);
        }

        $event_type = isset($_GET['event_type']) ? sanitize_text_field($_GET['event_type']) : '';
        if ($event_type && in_array($event_type, ['free', 'paid'], true)) {
            $query->set('meta_query', [
                [
                    'key'     => 'event_type',
                    'value'   => $event_type,
                    'compare' => '=',
                ],
            ]);
        }
    }

    public function inject_filter_template(string $block_content, array $block): string
    {
        if ($block['blockName'] !== 'core/query' || $this->injected) {
            return $block_content;
        }

        if (!$this->is_evenement_archive) {
            return $block_content;
        }

        $template = EVENTS_MANAGER_PATH . 'public/archive-filters.php';
        if (!file_exists($template)) {
            return $block_content;
        }

        ob_start();
        include $template;
        $form = ob_get_clean();

        $this->injected = true;

        return $form . $block_content;
    }
}
