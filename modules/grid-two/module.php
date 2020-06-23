<?php

namespace GoodMagazineElements\Modules\GridTwo;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-post-grid-two';
    }

    public function get_widgets() {
        $widgets = [
            'Grid_Two',
        ];
        return $widgets;
    }

}
