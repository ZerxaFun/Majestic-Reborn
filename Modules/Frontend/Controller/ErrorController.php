<?php

namespace Modules\Frontend\Controller;

use Controller;
use View;

/**
 * Class BackendController
 * @module Backend
 * @package Modules\Frontend\Controller
 */
class ErrorController extends FrontendController
{
    public function page404(): View
    {
        echo 5;
        return View::make('d');
    }
}
