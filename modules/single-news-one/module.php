<?php

namespace GoodMagazineElements\Modules\SingleNewsOne;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-single-news-one';
    }

    public function get_widgets() {
        $widgets = [
            'Single_News_One',
        ];
        return $widgets;
    }

}
