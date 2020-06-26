<?php

namespace GoodMagazineElements\Modules\GridOne;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-news-grid-one';
    }

    public function get_widgets() {
        $widgets = [
            'Grid_One',
        ];
        return $widgets;
    }

}
