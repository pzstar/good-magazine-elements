(function ($, elementor) {
    "use strict";
    var GMElements = {

        init: function () {

            var widgets = {
                'gm-post-slider-one.default': GMElements.sliderOneController,
                'gm-post-carousel-one.default': GMElements.carouselOneController,
                'gm-post-carousel-two.default': GMElements.carouselTwoController
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

            //elementor.hooks.addAction('frontend/element_ready/section', YooMagElements.elementorSection);
        },

        sliderOneController: function ($scope) {
            if ($('.gm-post-slider-one').length > 0) {
                $('.gm-post-slider-one').each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $(this).owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: false,
                        animateOut: 'fadeOut',
                        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>']
                    });
                });
            }
        },
        carouselOneController: function ($scope) {
            if ($('.gm-post-carousel-one').length > 0) {
                $('.gm-post-carousel-one').each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $(this).owlCarousel({
                        loop: true,
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: JSON.parse(params.dots),
                        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
                        responsive: {
                            0: {
                                items: params.items_mobile,
                                margin: params.margin_mobile,
                                stagePadding: params.stagepadding_mobile
                            },
                            480: {
                                items: params.items_tablet,
                                margin: params.margin_tablet,
                                stagePadding: params.stagepadding_tablet
                            },
                            768: {
                                items: params.items,
                                margin: params.margin,
                                stagePadding: params.stagepadding
                            }
                        }
                    });
                });
            }
        },
        carouselTwoController: function ($scope) {
            if ($('.gm-post-carousel-two').length > 0) {
                $('.gm-post-carousel-two').each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $(this).owlCarousel({
                        loop: true,
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: JSON.parse(params.dots),
                        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
                        responsive: {
                            0: {
                                items: params.items_mobile,
                                margin: params.margin_mobile,
                                stagePadding: params.stagepadding_mobile
                            },
                            480: {
                                items: params.items_tablet,
                                margin: params.margin_tablet,
                                stagePadding: params.stagepadding_tablet
                            },
                            768: {
                                items: params.items,
                                margin: params.margin,
                                stagePadding: params.stagepadding
                            }
                        }
                    });
                });
            }
        },

    };
    $(window).on('elementor/frontend/init', GMElements.init);
}(jQuery, window.elementorFrontend));
