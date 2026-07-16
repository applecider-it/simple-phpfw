<?php

namespace App\Views;

use SFW\View\View as BaseView;

/**
 * View管理
 */
class View extends BaseView
{
    function __construct()
    {
        $this->loader = new Loader($this);
    }
}
