<?php

namespace GoodMagazineElements;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Group_Control_Meta extends Group_Control_Base {

    protected static $fields;

    public static function get_type() {
        return 'good-magazine-elements-meta';
    }

    protected function init_fields() {
        $fields = [];

        $fields['post_author'] = [
            'label' => esc_html__('Post Author', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes',
            'separator' => 'before'
        ];

        $fields['post_date'] = [
            'label' => esc_html__('Post Date', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes'
        ];

        $fields['post_comment'] = [
            'label' => esc_html__('Post Comments', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes'
        ];

        return $fields;
    }

    protected function get_default_options() {
        return [
            'popover' => false,
        ];
    }

}
