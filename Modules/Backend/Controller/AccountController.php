<?php

namespace Modules\Backend\Controller;

use View;

class AccountController extends BackendController
{
    public static string $layout = 'login/login';

    public function signin(): View
    {
        return View::make('login/w');
    }
}