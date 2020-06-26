<?php

namespace GoodMagazineElements\Modules\GridThree;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-news-grid-three';
    }

    public function get_widgets() {
        $widgets = [
            'Grid_Three',
        ];
        return $widgets;
    }

}
