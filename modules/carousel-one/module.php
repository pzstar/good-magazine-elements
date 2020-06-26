<?php

namespace GoodMagazineElements\Modules\CarouselOne;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-news-carousel-one';
    }

    public function get_widgets() {
        $widgets = [
            'Carousel_One',
        ];
        return $widgets;
    }

}
