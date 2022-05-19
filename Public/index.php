<?php
declare(strict_types=1);

use Core\Bootstrap;
use Core\Services\DebugBar\StandardDebugBar;
use Core\Services\ErrorHandler\ErrorHandler;

/**
 *=====================================================
 * Majestic Next Engine - by Zerxa Fun                =
 *-----------------------------------------------------
 * @url: http://majestic-studio.com/                  =
 *-----------------------------------------------------
 * @copyright: 2021 Majestic Studio and ZerxaFun      =
 *=====================================================
 * @license GPL version 3                             =
 *=====================================================
 * index.php - исполняемый файл и точка входа         =
 * в систему.                                         =
 * Подключение composer и констант фреймворка         =
 *=====================================================
 */

require '../vendor/autoload.php';

    $debugbar = new StandardDebugBar();
    $debugbarRenderer = $debugbar->getJavascriptRenderer();
    $debugbar["messages"]->addMessage("hello world!", 'warning');
    $debugbar["messages"]->addMessage("hello world!", 'info');
    $debugbar["messages"]->addMessage("hello world!", 'error');
    Bootstrap::run(dirname(__DIR__));


    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <div style="position: absolute; background: red">sa</div>
    </body>
    </html>
<?php
dd($debugbarRenderer->render());

