<?php

namespace GoodMagazineElements\Modules\SinglePostOne\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class Single_Post_One extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'gm-single-post-one';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Single Post One', GME_TEXT_DOMAIN);
    }

    /** Icon */
    public function get_icon() {
        return 'good-mag-elements good-mag-single-post-one';
    }

    /** Category */
    public function get_categories() {
        return ['good-magazine-elements-blocks'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'section_post_query', [
            'label' => esc_html__('Content Filter', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_control(
                'post_id', [
            'label' => esc_html__('Select Post', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::SELECT2,
            'options' => good_magazine_elements_get_posts(),
            'label_block' => true
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
                'section_post_excerpt', [
            'label' => esc_html__('Post Excerpt', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_control('excerpt_length', [
            'label' => esc_html__('Excerpt Length (in Letters)', GME_TEXT_DOMAIN),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 200,
            'description' => esc_html__('Leave blank or enter 0 to hide the excerpt', GME_TEXT_DOMAIN),
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
                'section_post_extra', [
            'label' => esc_html__('Additional Settings', GME_TEXT_DOMAIN),
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'image',
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
                'size' => 60,
            ],
            'selectors' => [
                '{{WRAPPER}} .gm-post-thumb .gm-post-thumb-container' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="gm-single-post">

            <?php
            $args = array(
                'p' => $settings['post_id'],
                'ignore_sticky_posts' => 1
            );
            $post_query = new \WP_Query($args);

            if ($settings['post_id'] && $post_query->have_posts()) {
                ?>
                <div class="gm-single-post-one">
                    <?php
                    while ($post_query->have_posts()) {
                        $post_query->the_post();
                        $image_size = $settings['image_size'];
                        $excerpt_length = $settings['excerpt_length'];

                        good_magazine_elements_image($image_size);
                        ?>

                        <div class="gm-post-content gm-align-<?php echo $settings['content_alignment']; ?>">

                            <h3 class="gm-post-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>

                            <?php $this->get_post_meta(); ?>

                            <?php if ($excerpt_length) { ?>
                                <div class="gm-post-excerpt"><?php echo good_magazine_elements_custom_excerpt($excerpt_length); ?></div>
                            <?php } ?>
                        </div>
                        <?php
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
