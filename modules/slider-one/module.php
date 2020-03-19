<?php

namespace GoodMagazineElements\Modules\SliderOne;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-post-slider-one';
    }

    public function get_widgets() {
        $widgets = [
            'Slider_One',
        ];
        return $widgets;
    }

}
