<?php

/**
 * Helper Functions
 */
/** Get Post Lists */
if (!function_exists('good_magazine_elements_post_lists')) {

    function good_magazine_elements_post_lists($multiple) {
        $posts = get_posts(array('posts_per_page' => 100));

        if ($multiple) {
            $post_list = array('all' => __('All', 'good-magazine-elements'));
        } else {
            $post_list = array('none' => __('None', 'good-magazine-elements'));
        }

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $post_list[$post->post_name] = $post->post_title;
            }
        }

        return $post_list;
    }

}

/** Orderby List */
if (!function_exists('good_magazine_elements_orderby_list')) {

    function good_magazine_elements_orderby_list() {
        return array(
            'none' => __('None', 'good-magazine-elements'),
            'date' => __('Date', 'good-magazine-elements'),
            'title' => __('Title', 'good-magazine-elements'),
            'name' => __('Name', 'good-magazine-elements'),
            'ID' => __('ID', 'good-magazine-elements'),
        );
    }

}

/** Order List */
if (!function_exists('good_magazine_elements_order_list')) {

    function good_magazine_elements_order_list() {
        return array(
            'ASC' => __('Ascending', 'good-magazine-elements'),
            'DESC' => __('Descending', 'good-magazine-elements'),
        );
    }

}

/** Image Sizes List */
if (!function_exists('good_magazine_elements_imagesizes_list')) {

    function good_magazine_elements_imagesizes_list() {
        global $_wp_additional_image_sizes;

        $default_image_sizes = get_intermediate_image_sizes();
        $image_size_list = array();

        foreach ($default_image_sizes as $size) {
            $image_sizes[$size]['width'] = intval(get_option("{$size}_size_w"));
            $image_sizes[$size]['height'] = intval(get_option("{$size}_size_h"));
            $image_sizes[$size]['crop'] = get_option("{$size}_crop") ? get_option("{$size}_crop") : false;
        }

        if (isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes)) {
            $image_sizes = array_merge($image_sizes, $_wp_additional_image_sizes);
        }
        foreach ($image_sizes as $key => $value) {
            $image_size_list[$key] = ucfirst($key);
        }
        return $image_size_list;
    }

}

// Get all Authors
if (!function_exists('good_magazine_elements_get_auhtors')) {

    function good_magazine_elements_get_auhtors() {

        $options = array();

        $users = get_users();

        foreach ($users as $user) {
            $options[$user->ID] = $user->display_name;
        }

        return $options;
    }

}

/** Get Attachment Alt Tag */
if (!function_exists('good_magazine_elements_get_altofimage')) {

    function good_magazine_elements_get_altofimage($attachment) {
        $attachment_id = '';
        if ($attachment) {
            if (is_string($attachment)) {
                $attachment_id = attachment_url_to_postid($attachment);
            } elseif (is_int($attachment)) {
                $attachment_id = $attachment;
            }
            return get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
        }
    }

}

/** Get Image */
if (!function_exists('good_magazine_elements_image')) {

    function good_magazine_elements_image($image_size = 'full') {
        echo '<div class="gm-post-thumb">';
        echo '<a href="' . esc_url(get_the_permalink()) . '">';
        echo '<div class="gm-post-thumb-container">';
        the_post_thumbnail($image_size);
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }

}

/** Get All Authors */
if (!function_exists('good_magazine_elements_author_name')) {

    function good_magazine_elements_author_name() {
        echo '<span><i class="ti-pencil"></i>' . get_the_author() . '</span>';
    }

}

/** Get Comment Count */
if (!function_exists('good_magazine_elements_comment_count')) {

    function good_magazine_elements_comment_count() {
        echo '<span><i class="ti-comment"></i>' . get_comments_number() . '</span>';
    }

}

if (!function_exists('good_magazine_elements_post_date')) {

    function good_magazine_elements_post_date($format = '') {
        if ($format) {
            echo '<span><i class="ti-time"></i>' . get_the_date($format) . '</span>';
        } else {
            echo '<span><i class="ti-time"></i>' . get_the_date() . '</span>';
        }
    }

}


if (!function_exists('good_magazine_elements_time_ago')) {

    function good_magazine_elements_time_ago() {
        echo '<span><i class="ti-time"></i>' . human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('ago', 'good-magazine-elements') . '</span>';
    }

}

// Custom Excerpt
if (!function_exists('good_magazine_elements_custom_excerpt')) {

    function good_magazine_elements_custom_excerpt($limit) {
        if ($limit) {
            $content = get_the_content();
            $content = strip_tags($content);
            $content = strip_shortcodes($content);
            $excerpt = mb_substr($content, 0, $limit);

            if (strlen($content) >= $limit) {
                $excerpt = $excerpt . '...';
            }

            echo $excerpt;
        }
    }

}

/** Get All Posts */
if (!function_exists('good_magazine_elements_get_posts')) {

    function good_magazine_elements_get_posts() {

        $post_list = get_posts(array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        ));

        $posts = array();

        if (!empty($post_list) && !is_wp_error($post_list)) {
            foreach ($post_list as $post) {
                $posts[$post->ID] = $post->post_title;
            }
        }

        return $posts;
    }

}

/**
 * Queries for the elements
 *
 */
if (!function_exists('yoomag_ea_query')) {

    function yoomag_ea_query($settings, $first_id = '', $post_per_page = 4) {


        $post_type = $settings['posts_post_type'];
        $category = '';
        $tags = '';
        $exclude_posts = '';
        $post_formats = '';
        if (get_post_format()) {
            $post_formats = $settings['posts_post_format_ids'];
        }


        if (!empty($post_formats)) {
            $post_formats[] = implode(",", $post_formats);
        }



        if ('post' == $post_type) {

            $category = $settings['posts_category_ids'];
            $tags = $settings['posts_post_tag_ids'];
            $exclude_posts = $settings['posts_exclude_posts'];
        } elseif ('product' == $post_type) {

            $category = $settings['posts_product_cat_ids'];
            $exclude_posts = $settings['posts_exclude_posts'];
        }

        //Categories
        $post_cat = '';
        $post_cats = $category;
        if (!empty($category)) {
            asort($category);
        }

        if (!empty($post_cats)) {
            $post_cat = implode(",", $post_cats);
        }


        if (!empty($first_id)) {
            $post_cat = $category[0];
        }


        // Post Authors
        $post_author = '';
        $post_authors = $settings['posts_authors'];
        if (!empty($post_authors)) {
            $post_author = implode(",", $post_authors);
        }

        if ($post_formats) {

            $args = array(
                'post_type' => $post_type,
                'post__in' => '',
                'cat' => $post_cat,
                'author' => $post_author,
                'tag__in' => $tags,
                'orderby' => $settings['posts_orderby'],
                'order' => $settings['posts_order'],
                'post__not_in' => $exclude_posts,
                'offset' => $settings['posts_offset'],
                'ignore_sticky_posts' => 1,
                'posts_per_page' => $post_per_page,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'post_format',
                        'field' => 'slug',
                        'terms' => $post_formats,
                        'operator' => 'IN',
                    ),
                ),
            );
        } else {

            $args = array(
                'post_status' => array('publish'),
                'post_type' => $post_type,
                'post__in' => '',
                'cat' => $post_cat,
                'author' => $post_author,
                'tag__in' => $tags,
                'orderby' => $settings['posts_orderby'],
                'order' => $settings['posts_order'],
                'post__not_in' => $exclude_posts,
                'offset' => $settings['posts_offset'],
                'ignore_sticky_posts' => 1,
                'posts_per_page' => $post_per_page
            );
        }

        if ('product' == $post_type) {

            $args = array(
                'post_type' => 'product',
                'post__in' => '',
                'orderby' => $settings['posts_orderby'],
                'order' => $settings['posts_order'],
                'author' => $post_author,
                'posts_per_page' => $post_per_page,
                'post__not_in' => $exclude_posts,
                'offset' => $settings['posts_offset'],
            );

            if ($post_cat) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $post_cat
                    )
                );
            }
        }


        return $args;
    }

}