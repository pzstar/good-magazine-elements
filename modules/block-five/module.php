<?php

namespace GoodMagazineElements\Modules\BlockFive;

use GoodMagazineElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'gm-news-block-five';
    }

    public function get_widgets() {
        $widgets = [
            'Block_Five',
        ];
        return $widgets;
    }

}
