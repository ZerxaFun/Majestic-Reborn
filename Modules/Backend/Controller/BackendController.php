<?php

namespace Modules\Backend\Controller;

use Controller;
use Core\Services\Routing\Modules\Language;
use View;

/**
 * Class BackendController
 * @module Backend
 * @package Modules\Frontend\Controller
 */
class BackendController extends Controller
{
    final public function data(): void
    {
        Language::moduleLanguage();
    }

    public function home(): View
    {
        /**
         * Передача View данных контроллера.
         */
        return View::make('dashboard', $this->data);
    }

    public function dashboard(): View
    {
        /**
         * Передача View данных контроллера.
         */
        return View::make('dashboard', $this->data);
    }

    public function login(): View
    {
        return View::make('dashboard');
    }
}
