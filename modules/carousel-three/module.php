<?php

namespace GoodMagazineElements\Modules\CarouselThree;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-post-carousel-three';
    }

    public function get_widgets() {
        $widgets = [
            'Carousel_Three',
        ];
        return $widgets;
    }

}
