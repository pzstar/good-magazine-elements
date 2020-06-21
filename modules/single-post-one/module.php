<?php

namespace GoodMagazineElements\Modules\SinglePostOne;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-single-post-one';
    }

    public function get_widgets() {
        $widgets = [
            'Single_Post_One',
        ];
        return $widgets;
    }

}
