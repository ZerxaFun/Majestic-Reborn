<?php

namespace Core;

use DateTime;

class App
{
    public static array $modules = [];

    public static function load($module , bool $debug = false)
    {
        $start = microtime(true);
        sleep(rand(1, 4));
        $module;
        $stop = microtime(true) - $start;
        printf('Скрипт выполнялся %.4F сек. <br>', $stop);

    }


}