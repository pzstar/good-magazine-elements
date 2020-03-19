(function ($) {
    "use strict";

    var ajaxURL = yoomag_ajax_script.ajaxurl;

    /*Moduel One*/


    $('.yoomag-module-one .yoomag-header-filter a').on('click', function (event) {
        event.preventDefault();
        var $this = $(this),
        term = $this.data('term-id'),
        post_type = $this.data('post-type'),
        taxonomy = $this.data('taxonomy');

        $this.closest('.yoomag-header-filter').find('a').removeClass('active-item');
        $this.addClass('active-item');

        requestPosts($this, {post_type: post_type, taxonomy:taxonomy, term: term, paged: 1});

    });

    $('.cat-tabs-wrapp ul.tabbed-links li').first('li').addClass('active');


    /**
     * module-one
     */
    $('.ymmo-wrapp .cat-tabs-wrapp ul.tabbed-links li a,.ymmt-wrapp .cat-tabs-wrapp ul.tabbed-links li a').on('click', function (e) {

        var dis = $(this);
        var currentAttrValue = dis.attr('data-id');
        var titleExcerpt = dis.attr('data-title');
        var titleShow = dis.attr('title-show');
        var excerpts = dis.attr('data-count');
        var postMeta = dis.attr('post-meta');
        var postAuthor = dis.attr('post-author');
        var postDate = dis.attr('post-date');
        var postCat = dis.attr('post-category');
        var postExcerpt = dis.attr('post-excerpt');


        dis.parent('li').addClass('active').siblings().removeClass('active');

        if (dis.parents('.cat-tabs-wrapp').siblings('.block-content-wrapper').find('.' + currentAttrValue).length > 0) {
            dis.parents('.cat-tabs-wrapp').siblings('.block-content-wrapper').find('.block-cat-content').hide();
            dis.parents('.cat-tabs-wrapp').siblings('.block-content-wrapper').find('.' + currentAttrValue).show();

        } else {
            dis.parents('.cat-tabs-wrapp').siblings('.block-content-wrapper').find('.block-loader').show();
            $.ajax({
                url: ajaxURL,

                data: {
                    action: 'yoomag_module_one_ajax',
                    category_id: currentAttrValue,
                    title_length: titleExcerpt,
                    post_excerpt: excerpts,
                    title_show: titleShow,
                    post_meta: postMeta,
                    post_author: postAuthor,
                    post_date: postDate,
                    post_category: postCat,
                    show_excerpt: postExcerpt
                },
                type: 'post',
                success: function (res) {
                    dis.parents('.cat-tabs-wrapp').siblings('.block-content-wrapper').append(res);
                    dis.parents('.cat-tabs-wrapp').siblings('.block-content-wrapper').find('.block-cat-content').hide();
                    dis.parents('.cat-tabs-wrapp').siblings('.block-content-wrapper').find('.' + currentAttrValue).show();
                    $('.block-loader').hide();
                }
            });
        }

    });



    function requestPosts($trigger, data) {
        var $wrapper = $trigger.closest('.yoomag-module-one'),
                $loader = $wrapper.next('.jet-smart-listing-loading');

        if ($wrapper.hasClass('yoomag-processing')) {
            return;
        }

        $wrapper.addClass('yoomag-processing');

        $.ajax({
            url: ajaxURL,
            type: 'POST',
            data: {
                action: 'yoomag_module_one',
                data: data,
                settings: $wrapper.data('settings')
            },
        }).done(function (response) {
            var $arrows = $wrapper.find('.yoomag-listing-arrows');

            $wrapper
                    .removeClass('yoomag-processing')
                    .find('.yoomag-module-one-blocks')
                    .html(response);

            if ($arrows.length) {
                $arrows.replaceWith(response.data.arrows);
            }

        }).fail(function () {
            alert('fail');
            $wrapper.removeClass('yoomag-processing');
        });

        if ('undefined' !== typeof data.paged) {
            $wrapper.data('page', data.paged);
        }

        if ('undefined' !== typeof data.term) {
            $wrapper.data('term', data.term);
        }

    }




}(jQuery));