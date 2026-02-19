<?php

namespace EventsManager;

class Metaboxes
{
    public function register(): void
    {
        // Add metabox
        add_action('add_meta_boxes', [$this, 'custom_metabox']);
        $this->custom_metabox();
        // Save meta data
        add_action('save_post', [$this, 'save_custom_metabox_data']);
        add_filter('render_block', [$this, 'inject_event_date_after_content'], 10, 2);
    }

    private function custom_metabox(): void
    {
        add_meta_box(
            'event_metabox',
            'Informations additionnelles',
            [$this, 'render_custom_metabox'],
            PostType::POST_TYPE,
            'normal',
            'default'
        );
    }
    public function render_custom_metabox($post): void
    {
        $date_value = get_post_meta($post->ID, 'custom_date_field', true); // Get the saved date value
        ?>
        <label for="custom_date_field">Date de l'événement :</label>
        <input type="date" id="custom_date_field" name="custom_date_field" value="<?php echo esc_attr($date_value); ?>">
        <?php
    }

    public function save_custom_metabox_data($post_id): void
    {
        if (array_key_exists('custom_date_field', $_POST)) {
            update_post_meta(
                $post_id,
                'custom_date_field',
                sanitize_text_field($_POST['custom_date_field'])
            );
        }
    }

    function get_event_date($post_id = null): string
    {
        if (!$post_id) {
            $post_id = get_the_ID();
        }

        $date = get_post_meta($post_id, 'custom_date_field', true);
        if ($date) {
            return date_i18n(get_option('date_format'), strtotime($date));
        }
        return '';
    }

    public function inject_event_date_after_content($block_content, $block): mixed
    {
        // Only proceed if this is the last block and we're on an event post
        if (get_post_type() === 'evenement' && isset($block['blockName']) && $block['blockName'] === 'core/post-content') {
            $date = $this->get_event_date();
            if ($date) {
                $block_content .= '<div class="event-date">Date: ' . esc_html($date) . '</div>';
            }
        }
        return $block_content;
    }

}