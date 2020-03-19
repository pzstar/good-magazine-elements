<?php

namespace GoodMagazineElements\Modules\BlockOne;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-post-block-one';
    }

    public function get_widgets() {
        $widgets = [
            'Block_One',
        ];
        return $widgets;
    }

}
