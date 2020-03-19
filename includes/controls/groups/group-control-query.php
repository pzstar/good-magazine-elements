<?php

namespace GoodMagazineElements;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Group_Control_Query extends Group_Control_Base {

    protected static $fields;

    public static function get_type() {
        return 'good-magazine-elements-query';
    }

    protected function init_fields() {
        $fields = [];

        $fields['post_type'] = [
            'label' => esc_html__('Source', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SELECT,
        ];

        return $fields;
    }

    protected function prepare_fields($fields) {

        //$args = $this->get_args();

        $post_types = self::get_post_types();

        $fields['post_type']['options'] = $post_types;

        $fields['post_type']['default'] = 'post'; //key($post_types);

        $taxonomy_filter_args = [
            'show_in_nav_menus' => true,
        ];

        $taxonomies = get_taxonomies($taxonomy_filter_args, 'objects');

        foreach ($taxonomies as $taxonomy => $object) {
            $options = array();

            $terms = get_terms($taxonomy);

            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }

            $fields[$taxonomy . '_ids'] = [
                'label' => $object->label,
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $options,
                'condition' => [
                    'post_type' => $object->object_type,
                ],
            ];
        }

        $fields['exclude_posts'] = [
            'label' => esc_html__('Exclude Posts', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SELECT2,
            'label_block' => true,
            'multiple' => true,
            'options' => good_magazine_elements_get_posts(),
            'condition' => [
                'post_type' => 'post'
            ]
        ];

        $fields['orderby'] = [
            'label' => esc_html__('Order By', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'date' => esc_html__('Date', GME_TEXT_DOMAIN),
                'modified' => esc_html__('Last Modified Date', GME_TEXT_DOMAIN),
                'rand' => esc_html__('Rand', GME_TEXT_DOMAIN),
                'comment_count' => esc_html__('Comment Count', GME_TEXT_DOMAIN),
                'title' => esc_html__('Title', GME_TEXT_DOMAIN),
                'ID' => esc_html__('Post ID', GME_TEXT_DOMAIN),
                'author' => esc_html__('Post Author', GME_TEXT_DOMAIN),
            ],
            'default' => 'date',
        ];

        $fields['order'] = [
            'label' => esc_html__('Order', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'DESC' => esc_html__('Descending', GME_TEXT_DOMAIN),
                'ASC' => esc_html__('Ascending', GME_TEXT_DOMAIN),
            ],
            'default' => 'DESC',
        ];

        $fields['offset'] = [
            'label' => esc_html__('Offset', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => '',
        ];

        return parent::prepare_fields($fields);
    }

    private static function get_post_types() {
        $post_type_args = [
            'show_in_nav_menus' => true,
        ];

        $_post_types = get_post_types($post_type_args, 'objects');

        $post_types = [];

        foreach ($_post_types as $post_type => $object) {
            $post_types[$post_type] = $object->label;
        }

        return $post_types;
    }

    protected function get_default_options() {
        return [
            'popover' => false,
        ];
    }

}
