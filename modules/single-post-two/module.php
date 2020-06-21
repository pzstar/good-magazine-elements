<?php

namespace GoodMagazineElements\Modules\SinglePostTwo;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-single-post-two';
    }

    public function get_widgets() {
        $widgets = [
            'Single_Post_Two',
        ];
        return $widgets;
    }

}
