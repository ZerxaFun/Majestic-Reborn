<?php

use Core\Services\DevDumper\DevDumper;

if (!function_exists('dump')) {
    function dump($var, ...$moreVars) {
        DevDumper::dump($var);

        foreach ($moreVars as $v) {
            DevDumper::dump($v);
        }

        if (1 < func_num_args()) {
            return func_get_args();
        }

        return $var;
    }
}

if (!function_exists('dd')) {
    #[NoReturn] function dd(...$vars) {
        foreach ($vars as $v) {
            DevDumper::dump($v);
        }

        exit(1);
    }
}