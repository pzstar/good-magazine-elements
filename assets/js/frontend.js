(function ($, elementor) {
    "use strict";
    var GMElements = {

        init: function () {

            var widgets = {
                //'bdt-accordion.default': GMElements.widgetMap,
                'gm-post-slider-one.default': GMElements.sliderOneController
            };

            $.each(widgets, function (widget, callback) {
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

    };
    $(window).on('elementor/frontend/init', GMElements.init);
}(jQuery, window.elementorFrontend));
