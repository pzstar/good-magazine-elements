<?php
/**
 * Ajax request functions 
 *
 */
/**
 * Post title excerpt for ajax functions
 */
if (!function_exists('yoomag_ea_title_excerpt_ajax')):

    function yoomag_ea_title_excerpt_ajax($title_show, $title_length) {
        if ($title_show == 'yes') {

            $length = absint($title_length);
            $title = get_the_title();

            $limit_content = mb_substr($title, 0, $length);
            $title_length = strlen($title);
            if ($title_length > $length) {
                $limit_content .= '...';
            }

            $content = $title;
            if ($length) {
                $content = $limit_content;
            }

            $final_content = '<h2 class="post-title">';
            $final_content .= '<a href="' . get_the_permalink() . '">';
            $final_content .= $content;
            $final_content .= '</a>';
            $final_content .= '</h2>';
            return $final_content;
        }
    }

endif;


/**
 * Function to generate post meta for ajax
 *
 */
if (!function_exists('yoomag_ea_post_meta_ajax')):

    function yoomag_ea_post_meta_ajax($post_meta, $post_author, $post_date) {

        if ($post_meta == 'yes') {
            ?>
            <div class="post-meta">
                <?php if ($post_author == 'yes') { ?>
                    <span class="ym-post-author">
                        <?php echo get_the_author(); ?>
                    </span>
                <?php } ?>

                <?php
                if ($post_date == 'yes') {
                    $time_string = sprintf('<time class="entry-date" datetime="%1$s">%2$s</time>', esc_attr(get_the_date('c')), get_the_date()
                    );

                    printf('<span class="ym-post-date"><span class="screen-reader-text">%1$s </span>%2$s</span>', __('Posted on', GME_TEXT_DOMAIN), $time_string
                    );
                }
                ?>
            </div>
            <?php
        }
    }

endif;


add_action('wp_ajax_yoomag_module_one', 'yoomag_module_one');
add_action('wp_ajax_nopriv_yoomag_module_one', 'yoomag_module_one');

function yoomag_module_one() {
    ob_start();
    $settings = $_POST['settings'];
    $data = $_POST['data'];
    $args = [
        'post_type' => $settings['posts_post_type'],
        'orderby' => $settings['posts_orderby'],
        'order' => $settings['posts_order'],
        'ignore_sticky_posts' => 1,
        'post_status' => 'publish',
        'paged' => $data['paged'],
        'offset' => $settings['posts_offset'],
        'post__not_in' => []
    ];
    
    if($data['term'] != 0){
        $args['tax_query'][] = [
            'taxonomy' => $data['taxonomy'],
            'field' => 'term_id',
            'terms' => $data['term'],
        ];
    }else{
        $args['tax_query'][] = $settings['default_query'];
    }
    
    $args['posts_per_page'] = $settings['featured_post_count'];

    $query = new WP_Query($args);

    $fallback_image = $settings['fallback_image'];
    $placeholder_image_src = Elementor\Utils::get_placeholder_image_src();
    ?>
    <?php if ($query->have_posts()) { ?>
        <div class="yoomag-module-one-featured-block">
            <?php
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="yoomag-module-one-featured-post">
                    <div class="yoomag-featured-block-img">
                        <?php
                        if (has_post_thumbnail()) {
                            $image_url = Elementor\Group_Control_Image_Size::get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'featured_image', $settings);
                            ?>
                            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            </a>
                            <?php
                        } else {
                            if ($fallback_image == 'placeholder') {
                                $image_url = $placeholder_image_src;
                                ?>
                                <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </a>
                                <?php
                            } else if ($fallback_image == 'custom' && !empty($settings['fallback_image_custom']['id'])) {
                                $image_url = Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['fallback_image_custom']['id'], 'featured_image', $settings);
                                ?>
                                <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </a>
                                <?php
                            }
                        }
                        ?>      
                    </div>
                    <h5><?php the_title(); ?></h5>
                    <?php
                    if ($settings['post_meta']) {
                        if ($settings['post_author'] == 'yes') {
                            yoomag_post_author();
                        }

                        if ($settings['post_date'] == 'yes') {
                            $date_format = $settings['date_format'];

                            if ($date_format == 'relative_format') {
                                echo yoomag_time_ago();
                            } else if ($date_format == 'default') {
                                echo get_the_date();
                            } else if ($date_format == 'custom') {
                                $format = $settings['date_format_custom'];
                                yoomag_post_date($format);
                            }
                        }

                        if ($settings['post_comment'] == 'yes') {
                            yoomag_post_comment();
                        }
                    }
                    ?>
                    <?php
                    if ($settings['featured_post_excerpt'] == 'yes') {
                        ?>
                        <div class="yoomag-featured-block-excerpt">
                            <?php
                            echo yoomag_custom_excerpt($settings['featured_post_excerpt_length']);
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php }
            ?>
        </div>
        <?php
    }


    $args['posts_per_page'] = $settings['list_post_count'];
    $args['offset'] = absint($settings['featured_post_count']) + absint($args['offset']);
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ?>
        <div class="yoomag-module-one-list-block">
            <?php
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="yoomag-module-one-list-post">
                    <div class="yoomag-list-block-img">
                        <?php
                        if (has_post_thumbnail()) {
                            $image_url = Elementor\Group_Control_Image_Size::get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'list_image', $settings);
                            ?>
                            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            </a>
                            <?php
                        } else {
                            if ($fallback_image == 'placeholder') {
                                $image_url = $placeholder_image_src;
                                ?>
                                <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </a>
                                <?php
                            } else if ($fallback_image == 'custom' && !empty($settings['fallback_image_custom']['id'])) {
                                $image_url = Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['fallback_image_custom']['id'], 'list_image', $settings);
                                ?>
                                <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <h5><?php the_title(); ?></h5>
                    <?php
                    if ($settings['post_meta']) {
                        if ($settings['post_author'] == 'yes') {
                            yoomag_post_author();
                        }

                        if ($settings['post_date'] == 'yes') {
                            $date_format = $settings['date_format'];

                            if ($date_format == 'relative_format') {
                                echo yoomag_time_ago();
                            } else if ($date_format == 'default') {
                                echo get_the_date();
                            } else if ($date_format == 'custom') {
                                $format = $settings['date_format_custom'];
                                yoomag_post_date($format);
                            }
                        }

                        if ($settings['post_comment'] == 'yes') {
                            yoomag_post_comment();
                        }
                    }
                    ?>
                    <?php
                    if ($settings['list_post_excerpt'] == 'yes') {
                        ?>
                        <div class="yoomag-list-block-excerpt">
                            <?php
                            echo yoomag_custom_excerpt($settings['featured_post_excerpt_length']);
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php }
            ?>
        </div>
        <?php
    }
    ?>
    <?php
    $return_data = ob_get_contents();
    ob_get_clean();
    echo $return_data;
    die();
}

/**
 * Module layout one ajax function
 * module-one
 */
add_action('wp_ajax_yoomag_module_one_ajax', 'yoomag_module_one_ajax');
add_action('wp_ajax_nopriv_yoomag_module_one_ajax', 'yoomag_module_one_ajax');

if (!function_exists('yoomag_module_one_ajax')):

    function yoomag_module_one_ajax() {

        ob_start();

        $cat_id = $_POST['category_id'];
        $show_excerpt = $_POST['show_excerpt'];
        $excerpt_length = $_POST['post_excerpt'];
        $title_show = $_POST['title_show'];
        $title_length = $_POST['title_length'];
        $post_meta = $_POST['post_meta'];
        $post_author = $_POST['post_author'];
        $post_date = $_POST['post_date'];
        $post_category = $_POST['post_category'];
        ?>
        <div class="block-cat-content <?php echo esc_attr($cat_id); ?>">
            <?php
            $block_args = array(
                'category__in' => $cat_id,
                'posts_per_page' => 5
            );
            $block_query = new WP_Query($block_args);
            $count = 1;

            if ($block_query->have_posts()) : while ($block_query->have_posts()) : $block_query->the_post();
                    $total_posts = $block_query->post_count;

                    if ($count == 1) {
                        ?>
                        <div class="first-post-wrap">
                        <?php } elseif ($count == 2) { ?>
                            <div class="second-post-wrapp">
                                <?php
                            }

                            //cont start here
                            ?>
                            <div class="post-inner-wrapp <?php echo esc_attr('post-' . $count); ?>">
                                <div class="ym-post-bg">
                                    <?php //if ( $thumb_url ) { ?>
                                    <?php the_post_thumbnail(); ?>
                                    <?php //}   ?>
                                </div>
                                <div class="ym-img-overlay"></div>
                                <div class="post-content">
                                    <?php if ($post_meta == 'yes') { ?>
                                        <?php if (($post_category == 'yes') && ($count == 1)) { ?>
                                            <div class="post-categories">
                                                <span>
                                                    <?php
                                                    $category = get_the_category();
                                                    if ($category) {
                                                        echo esc_attr($category[0]->name);
                                                    }
                                                    ?>
                                                </span>
                                            </div><!--.ym-post-categories-->
                                        <?php } ?>
                                    <?php } ?>
                                    <?php echo yoomag_ea_title_excerpt_ajax($title_show, $title_length) ?>

                                    <?php yoomag_ea_post_meta_ajax($post_meta, $post_author, $post_date); ?>

                                    <?php if (($count == 1) && ($show_excerpt == 'yes')) { ?>
                                        <?php yoomag_ea_get_excerpt_content($excerpt_length) ?>
                                    <?php } ?>
                                </div><!--.post-inner-->
                            </div>
                            <?php
                            //end of contents

                            if ($count == 1 || $count == $total_posts) {
                                ?>
                            </div>
                            <?php
                        }


                        $count++;
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>

            </div>

            <?php
            $return_data = ob_get_contents();
            ob_get_clean();
            echo $return_data; //Escaping of all variables already done above
            die();
        }

endif;


