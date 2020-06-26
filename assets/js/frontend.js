(function ($, elementor) {
    "use strict";
    var GMElements = {

        init: function () {

            var widgets = {
                'gm-news-slider-one.default': GMElements.sliderOneController,
                'gm-news-carousel-one.default': GMElements.carouselOneController,
                'gm-news-carousel-two.default': GMElements.carouselTwoController,
                'gm-news-carousel-three.default': GMElements.carouselThreeController
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },

        sliderOneController: function ($scope) {
            var $element = $scope.find('.gm-post-slider-one');
            if ($element.length > 0) {
                $element.each(function () {
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
            var $element = $scope.find('.gm-post-carousel-one');
            if ($element.length > 0) {
                $element.each(function () {
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
            var $element = $scope.find('.gm-post-carousel-two');
            if ($element.length > 0) {
                $element.each(function () {
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
        carouselThreeController: function ($scope) {
            var $element = $scope.find('.gm-post-carousel-three');
            if ($element.length > 0) {
                $element.each(function () {
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
