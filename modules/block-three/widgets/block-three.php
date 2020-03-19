<?php

namespace GoodMagazineElements\Modules\BlockThree\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use GoodMagazineElements\Group_Control_Query;
use GoodMagazineElements\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class Block_Three extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'gm-post-block-three';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Post Block Three', GME_TEXT_DOMAIN);
    }

    /** Icon */
    public function get_icon() {
        return 'fa fa-code';
    }

    /** Category */
    public function get_categories() {
        return ['good-magazine-elements-blocks'];
    }

    /** Controls */
    protected function _register_controls() {
        $this->start_controls_section(
                'header', [
            'label' => esc_html__('Header', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_group_control(
                Group_Control_Header::get_type(), [
            'name' => 'header',
            'label' => esc_html__('Header', GME_TEXT_DOMAIN),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_post_query', [
            'label' => esc_html__('Content Filter', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_group_control(
                Group_Control_Query::get_type(), [
            'name' => 'posts',
            'label' => esc_html__('Posts', GME_TEXT_DOMAIN),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_featured_block', [
            'label' => esc_html__('Featured Block', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'featured_post_image',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large',
                ]
        );

        $this->add_control(
                'featured_thumb_height', [
            'label' => esc_html__('Image Height(%)', 'plugin-name'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 30,
                    'max' => 150,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 70,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-left-block .gm-post-thumb-container' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control('featured_excerpt_length', [
            'label' => esc_html__('Excerpt Length', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 250
        ]);

        $this->add_control(
                'featured_post_author', [
            'label' => esc_html__('Post Author', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes',
            'separator' => 'before',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'featured_post_date', [
            'label' => esc_html__('Post Date', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'featured_post_comment', [
            'label' => esc_html__('Post Comments', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_listing_block', [
            'label' => esc_html__('Listing Block', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'list_post_image',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large',
                ]
        );

        $this->add_control(
                'listing_thumb_height', [
            'label' => esc_html__('Image Height(%)', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 30,
                    'max' => 150,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 70,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-right-block .gm-post-thumb-container' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'listing_post_count', [
            'label' => esc_html__('No of Posts', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 4,
            ],
                ]
        );

        $this->add_control('listing_excerpt_length', [
            'label' => esc_html__('Excerpt Length', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 0
        ]);

        $this->add_control(
                'listing_post_author', [
            'label' => esc_html__('Post Author', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes',
            'separator' => 'before'
                ]
        );

        $this->add_control(
                'listing_post_date', [
            'label' => esc_html__('Post Date', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'listing_post_comment', [
            'label' => esc_html__('Post Comments', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
                'additional_settings', [
            'label' => esc_html__('Additional Settings', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_control(
                'date_format', [
            'label' => esc_html__('Date Format', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'relative_format' => esc_html__('Relative Format (Ago)', GME_TEXT_DOMAIN),
                'default' => esc_html__('WordPress Default Format', GME_TEXT_DOMAIN),
                'custom' => esc_html__('Custom Format', GME_TEXT_DOMAIN),
            ],
            'default' => 'default',
            'separator' => 'before',
            'label_block' => true
                ]
        );

        $this->add_control(
                'custom_date_format', [
            'label' => esc_html__('Custom Date Format', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::TEXT,
            'default' => 'F j, Y',
            'placeholder' => esc_html__('F j, Y', GME_TEXT_DOMAIN),
            'condition' => [
                'date_format' => 'custom'
            ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'heading_style', [
            'label' => esc_html__('Heading Text', GME_TEXT_DOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'heading_color', [
            'label' => esc_html__('Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-post-block1 .good-magazine-post-main-header, {{WRAPPER}} .gm-post-block1 .good-magazine-post-main-header a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'heading_typography',
            'label' => esc_html__('Typography', GME_TEXT_DOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .gm-post-block1 .good-magazine-post-main-header, {{WRAPPER}} .gm-post-block1 .good-magazine-post-main-header a',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'featured_title_style', [
            'label' => esc_html__('Featured Block Title', GME_TEXT_DOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'featured_title_color', [
            'label' => esc_html__('Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-post-block-three .gm-left-block h3.gm-post-title a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'featured_title_typography',
            'label' => esc_html__('Typography', GME_TEXT_DOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .gm-post-block-three .gm-left-block h3.gm-post-title',
                ]
        );

        $this->add_control(
                'featured_title_margin', [
            'label' => esc_html__('Margin', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .gm-post-block-three .gm-left-block h3.gm-post-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'list_title_style', [
            'label' => esc_html__('Listing Block Title', GME_TEXT_DOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'list_title_color', [
            'label' => esc_html__('Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-post-block-three .gm-right-block h3.gm-post-title a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'list_title_typography',
            'label' => esc_html__('Typography', GME_TEXT_DOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .gm-post-block-three .gm-right-block h3.gm-post-title a',
                ]
        );

        $this->add_control(
                'list_title_margin', [
            'label' => esc_html__('Margin', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .gm-post-block-three .gm-right-block h3.gm-post-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'excerpt_style', [
            'label' => esc_html__('Post Excerpt', GME_TEXT_DOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'excerpt_color', [
            'label' => esc_html__('Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-post-block-three .gm-left-block .gm-post-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'excerpt_typography',
            'label' => esc_html__('Typography', GME_TEXT_DOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .gm-post-block-three .gm-left-block .gm-post-excerpt',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'post_metas', [
            'label' => esc_html__('Post Metas', GME_TEXT_DOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'post_metas_color', [
            'label' => esc_html__('Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-post-block-three .gm-post-meta span' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'post_metas_typography',
            'label' => esc_html__('Typography', GME_TEXT_DOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .gm-post-block-three .gm-post-meta span',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="gm-post-block">

            <?php $this->render_header(); ?>

            <?php
            $args = $this->query_args();
            $post_query = new \WP_Query($args);
            $counter = 1;
            ?>

            <?php if ($post_query->have_posts()) { ?>
                <div class="gm-post-block-three">
                    <?php
                    while ($post_query->have_posts()) {
                        $post_query->the_post();
                        $current_post_count = $post_query->current_post + 1;
                        $total_post_count = $post_query->post_count;
                        $image_size = ( $current_post_count == 1 ) ? $settings['featured_post_image_size'] : $settings['list_post_image_size'];
                        $title_class = ( $current_post_count == 1 ) ? ' gm-big-title' : '';
                        ?>
                        <?php if ($current_post_count == 1) { ?>
                            <div class="gm-left-block">
                            <?php }; ?>

                            <div class="gm-post-list">
                                <?php good_magazine_elements_image($image_size); ?>

                                <div class="gm-post-content">

                                    <h3 class="gm-post-title<?php echo esc_attr($title_class); ?>"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>

                                    <?php $this->get_post_meta($current_post_count); ?>

                                    <?php $this->get_post_excerpt($current_post_count); ?>
                                </div>
                            </div>

                            <?php if ($current_post_count == 1) { ?>
                            </div>

                            <?php if ($total_post_count > 1) { ?>
                                <div class="gm-right-block">
                                    <?php
                                }
                            }
                            ?>

                            <?php if ($total_post_count > 1 && $total_post_count == $current_post_count) { ?>
                            </div>
                        <?php } ?>
                        <?php
                        $counter++;
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <?php
            }
            ?>

        </div>
        <?php
    }

    /** Render Header */
    protected function render_header() {
        $settings = $this->get_settings();

        $this->add_render_attribute('header_attr', 'class', [
            'good-magazine-post-main-header',
                ]
        );

        $link_open = $link_close = "";
        $target = $settings['header_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['header_link']['nofollow'] ? ' rel="nofollow"' : '';

        if ($settings['header_link']['url']) {
            $link_open = '<a href="' . $settings['header_link']['url'] . '"' . $target . $nofollow . '>';
            $link_close = '</a>';
        }

        if ($settings['header_title']) {
            ?>
            <h5 <?php echo $this->get_render_attribute_string('header_attr'); ?>>
                <?php
                echo $link_open;
                echo $settings['header_title'];
                echo $link_close;
                ?>
            </h5>
            <?php
        }
    }

    /** Query Args */
    protected function query_args() {
        $settings = $this->get_settings();

        $post_type = $args['post_type'] = $settings['posts_post_type'];
        $args['orderby'] = $settings['posts_orderby'];
        $args['order'] = $settings['posts_order'];
        $args['ignore_sticky_posts'] = 1;
        $args['post_status'] = 'publish';
        $args['offset'] = $settings['posts_offset'];
        $args['posts_per_page'] = (int) $settings['listing_post_count']['size'] + 1;
        $args['post__not_in'] = $post_type == 'post' ? $settings['posts_exclude_posts'] : [];

        $args['tax_query'] = [];

        $taxonomies = get_object_taxonomies($post_type, 'objects');

        foreach ($taxonomies as $object) {
            $setting_key = 'posts_' . $object->name . '_ids';

            if (!empty($settings[$setting_key])) {
                $args['tax_query'][] = [
                    'taxonomy' => $object->name,
                    'field' => 'term_id',
                    'terms' => $settings[$setting_key],
                ];
            }
        }

        return $args;
    }

    /** Get Post Excerpt */
    protected function get_post_excerpt($count) {
        $settings = $this->get_settings_for_display();
        $excerpt_length = $count == 1 ? $settings['featured_excerpt_length'] : $settings['listing_excerpt_length'];
        if ($excerpt_length) {
            ?>
            <div class="gm-post-excerpt"><?php echo good_magazine_elements_custom_excerpt($excerpt_length); ?></div>
            <?php
        }
    }

    /** Get Post Metas */
    protected function get_post_meta($count) {
        $settings = $this->get_settings_for_display();
        $post_author = $count == 1 ? $settings['featured_post_author'] : $settings['listing_post_author'];
        $post_date = $count == 1 ? $settings['featured_post_date'] : $settings['listing_post_date'];
        $post_comment = $count == 1 ? $settings['featured_post_comment'] : $settings['listing_post_comment'];

        if ($post_author == 'yes' || $post_date == 'yes' || $post_comment == 'yes') {
            ?>
            <div class="gm-post-meta">
                <?php
                if ($post_author == 'yes') {
                    good_magazine_elements_author_name();
                }

                if ($post_date == 'yes') {
                    $date_format = $settings['date_format'];

                    if ($date_format == 'relative_format') {
                        good_magazine_elements_time_ago();
                    } else if ($date_format == 'default') {
                        good_magazine_elements_post_date();
                    } else if ($date_format == 'custom') {
                        $format = $settings['custom_date_format'];
                        good_magazine_elements_post_date($format);
                    }
                }

                if ($post_comment == 'yes') {
                    good_magazine_elements_comment_count();
                }
                ?>
            </div>
            <?php
        }
    }

}
