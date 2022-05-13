<?php

namespace Core\Services\Client;

use Core\Services\Routing\Route;

class Module
{
    public function getModule()
    {
        $module = new Route();

        return $module;
    }

    public function getModuleLanguage(string $module)
    {

    }
}
