<?php

namespace EventsManager;

use Geniem\ACF\ConditionalLogicGroup;
use Geniem\ACF\Field;
use Geniem\ACF\Field\Text;
use Geniem\ACF\Group;
use Geniem\ACF\RuleGroup;

class CustomFields
{
    public function register(): void
    {
        $field_group = new Group("Codifier fields");
        $field_group->set_key('custom_fields')
            ->register();

        $rules_group = new RuleGroup();
        $rules_group->add_rule('post_type', '==', PostType::POST_TYPE);

        $field_group->add_rule_group($rules_group);

        $text_field = new Text("Organisateur");
        $field_group->add_field($text_field);

        $event_type_field = (new Field\Select("Event Type", 'event_type', 'event_type'))
            ->set_choices([
               'free' => __('Free', 'events-manager'),
               'paid' => __('Paid', 'events-manager'),
            ]);
        $field_group->add_field($event_type_field);
    }
}
