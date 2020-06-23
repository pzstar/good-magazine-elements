<?php

namespace GoodMagazineElements\Modules\GridFour;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-post-grid-four';
    }

    public function get_widgets() {
        $widgets = [
            'Grid_Four',
        ];
        return $widgets;
    }

}
