<?php
declare(strict_types=1);

/**
 *=====================================================
 * Majestic Engine                                    =
 *=====================================================
 * @package Core\Bootstrap                            =
 *-----------------------------------------------------
 * @url http://majestic-studio.com/                   =
 *-----------------------------------------------------
 * @copyright 2021 Majestic Studio                    =
 *=====================================================
 * @author ZerxaFun aKa Zerxa                         =
 *=====================================================
 * @license GPL version 3                             =
 *=====================================================
 *                                                    =
 *                                                    =
 *=====================================================
 */

namespace Core;


use Core\Services\Auth\Auth;
use Core\Services\Client\Client;
use Core\Services\Container\DI;
use Core\Services\Database\Database;
use Core\Services\Environment\Dotenv;
use Core\Services\ErrorHandler\ErrorHandler;
use Core\Services\Http\Uri;
use Core\Services\Orm\Query;
use Core\Services\Routing\Controller;
use Core\Services\Routing\Route;
use Core\Services\Routing\Router;
use Core\Services\Session\Facades\Session;
use Core\Services\Template\Layout;
use Core\Services\Template\Theme\Theme;
use Core\Services\Template\View;
use Exception;


/**
 * Инициализация проекта.
 * 
 * Подключение необходимых альянсов и инициализация модулей ядра.
 */
class Bootstrap
{
    /**
     * @throws Exception
     */
    public static function run(string $pathApplication): void
    {
        /**
         * Установка корневого патча системы.
         */
        DI::instance()->set('baseDir', $pathApplication);

        /**
         * Загрузка классов необходимых для работы
         */
        class_alias(DI::class, 'DI');
        class_alias(Controller::class, 'Controller');
        class_alias(Layout::class, 'Layout');
        class_alias(Route::class, 'Route');
        class_alias(Query::class, 'Query');
        class_alias(View::class, 'View');
        class_alias(Theme::class, 'Theme');

        /**
         * Инициализация сессий.
         */
        $start = microtime(true);


        Session::initialize();
        $stop = microtime(true) - $start;
        printf('Скрипт Session выполнялся %.4F сек. <br>', $stop);
        $res = $stop;
        $start = microtime(true);

        /**
         * Инициализация клиента.
         */
        Client::initialize();
        $stop = microtime(true) - $start;
        printf('Скрипт Client выполнялся %.4F сек. <br>', $stop);$res = $res + $stop;

        $start = microtime(true);

        /**
         * Инициализация URI.
         */
        Uri::initialize();
        $stop = microtime(true) - $start;
        printf('Скрипт Uri выполнялся %.4F сек. <br>', $stop);$res = $res + $stop;
        $start = microtime(true);

        /**
         * Правильный вывод ошибок
         */
        ErrorHandler::initialize();
        $stop = microtime(true) - $start;
        printf('Скрипт ErrorHandler выполнялся %.4F сек. <br>', $stop);$res = $res + $stop;
        $start = microtime(true);

        /**
         * Парсинг .env файлов окружения
         */
        Dotenv::initialize();
        $stop = microtime(true) - $start;
        printf('Скрипт Dotenv выполнялся %.4F сек. <br>', $stop);$res = $res + $stop;
        $start = microtime(true);

        /**
         * Подключение к базе данных.
         */
        Database::initialize();
        $stop = microtime(true) - $start;
        printf('Скрипт Dotenv выполнялся %.4F сек. <br>', $stop);$res = $res + $stop;
        $start = microtime(true);

        Auth::initialize();
        $stop = microtime(true) - $start;
        printf('Скрипт Dotenv выполнялся %.4F сек. <br>', $stop);$res = $res + $stop;
        $start = microtime(true);

        /**
         * Подключение MVC паттерна
         */
        Router::initialize();
        $stop = microtime(true) - $start;
        printf('Скрипт Router выполнялся %.4F сек. <br>', $stop);$res = $res + $stop;
        $start = microtime(true);

        /**
         * Закрытие подключения к базе данных после окончания запроса.
         */
        Database::finalize();
        $stop = microtime(true) - $start;
        printf('Скрипт Database::finalize выполнялся %.4F сек. <br>', $stop);$res = $res + $stop;

        printf('Скрипт выполнялся %.4F сек. <br>', $res);
    }

}