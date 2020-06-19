<?php

namespace GoodMagazineElements\Modules\GridOne\Widgets;

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
class Grid_One extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'gm-post-grid-one';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Post Grid One', GME_TEXT_DOMAIN);
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
                'section_post_meta', [
            'label' => esc_html__('Post Meta', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_control(
                'post_author', [
            'label' => esc_html__('Post Author', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'post_date', [
            'label' => esc_html__('Post Date', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', GME_TEXT_DOMAIN),
            'label_off' => esc_html__('No', GME_TEXT_DOMAIN),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'post_comment', [
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
                'section_post_extra', [
            'label' => esc_html__('Additional Settings', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'slide_image',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large',
                ]
        );

        $this->add_control(
                'image_height', [
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
                '{{WRAPPER}} .gm-post-image .gm-post-thumb-container' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'content_alignment', [
            'label' => esc_html__('Content Alignment', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'left' => esc_html__('Left', GME_TEXT_DOMAIN),
                'center' => esc_html__('Center', GME_TEXT_DOMAIN),
                'right' => esc_html__('Right', GME_TEXT_DOMAIN),
            ],
            'default' => 'left'
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
                '{{WRAPPER}} .gm-post-slider h5, {{WRAPPER}} .gm-post-slider h5 a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'heading_typography',
            'label' => esc_html__('Typography', GME_TEXT_DOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .gm-post-slider h5,{{WRAPPER}} .gm-post-slider h5 a',
                ]
        );

        $this->add_control(
                'heading_margin', [
            'label' => esc_html__('Margin', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .gm-post-slider h5' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Post Title', GME_TEXT_DOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-post-title a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', GME_TEXT_DOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .gm-post-title a',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} h3.gm-post-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
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
                '{{WRAPPER}} .gm-post-content .gm-post-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'excerpt_typography',
            'label' => esc_html__('Typography', GME_TEXT_DOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .gm-post-content .gm-post-excerpt',
                ]
        );

        $this->add_control(
                'excerpt_margin', [
            'label' => esc_html__('Margin', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .gm-post-content .gm-post-excerpt' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'meta_style', [
            'label' => esc_html__('Post Metas', GME_TEXT_DOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'meta_color', [
            'label' => esc_html__('Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-post-meta span' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'meta_typography',
            'label' => esc_html__('Typography', GME_TEXT_DOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .gm-post-meta span',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'navingation_style', [
            'label' => esc_html__('Navigation', GME_TEXT_DOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'style_tabs'
        );

        $this->start_controls_tab(
                'style_normal_tab', [
            'label' => esc_html__('Normal', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_control(
                'nav_bg_color', [
            'label' => esc_html__('Button Background Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_icon_color', [
            'label' => esc_html__('Button Icon Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_bg_color', [
            'label' => esc_html__('Dots Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel button.owl-dot' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'style_hover_tab', [
            'label' => esc_html__('Hover', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_control(
                'nav_bg_color_hover', [
            'label' => esc_html__('Button Background Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_icon_color_hover', [
            'label' => esc_html__('Navigation Button Icon Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_bg_color_hover', [
            'label' => esc_html__('Dots Color', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-carousel button.owl-dot:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_size = $settings['slide_image_size'];
        $content_alignment = $settings['content_alignment'];
        $args = $this->query_args();
        $post_query = new \WP_Query($args);

        ?>
        <div class="gm-post-grid-block">
            <!-- Heading -->
            <?php $this->render_header(); ?>

            <!-- Post Lists -->
            <?php if ($post_query->have_posts()) : ?>
                <div class="gm-post-grid-one">
                    <?php while ($post_query->have_posts()) : $post_query->the_post();
                    $count = $post_query->current_post +1; 
                    ?>
                        <div class="gm-post gm-post-<?php echo $count; ?>">
                            <div class="gm-post-image gm-post-graident-title">
                                <?php good_magazine_elements_image($image_size); ?>
                                <div class="gm-post-content gm-align-<?php echo esc_attr($content_alignment); ?>">
                                    <?php $this->get_post_title(); ?>
                                    <?php $this->get_post_meta(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php
                wp_reset_postdata();
            endif;
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
        $args['posts_per_page'] = 8;
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

    /** Get Post Title */
    protected function get_post_title() {
        ?>
        <h3 class="gm-post-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
        <?php
    }

    /** Get Post Metas */
    protected function get_post_meta() {
        $settings = $this->get_settings_for_display();
        $post_author = $settings['post_author'];
        $post_date = $settings['post_date'];
        $post_comment = $settings['post_comment'];

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
