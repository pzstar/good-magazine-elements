<?php

namespace GoodMagazineElements\Modules\BlockEight;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-news-block-eight';
    }

    public function get_widgets() {
        $widgets = [
            'Block_Eight',
        ];
        return $widgets;
    }

}
