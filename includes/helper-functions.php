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

/** Get All Categories */
if (!function_exists('good_magazine_elements_get_categories')) {

    function good_magazine_elements_get_categories() {
        $cats = array();

        $terms = get_categories(array(
            'hide_empty' => true
        ));

        foreach ($terms as $term) {
            $cats[$term->term_id] = $term->name;
        }

        return $cats;
    }

}

/** Get All Tags */
if (!function_exists('good_magazine_elements_get_tags')) {

    function good_magazine_elements_get_tags() {
        $tags = array();

        $terms = get_tags(array(
            'hide_empty' => true
        ));

        foreach ($terms as $term) {
            $tags[$term->term_id] = $term->name;
        }

        return $tags;
    }

}