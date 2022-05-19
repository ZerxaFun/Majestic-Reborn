<?php
/**
 *=====================================================
 * Majestic Engine - by Zerxa Fun (Majestic Studio)   =
 *-----------------------------------------------------
 * @url: http://majestic-studio.ru/                   -
 *-----------------------------------------------------
 * @copyright: 2020 Majestic Studio and ZerxaFun      -
 *=====================================================
 *                                                    =
 *                                                    =
 *                                                    =
 *=====================================================
 */


namespace Core\Services\Routing;


use Core\Services\Auth\Auth;
use Core\Services\Client\Client;
use Core\Services\Routing\Modules\Language;
use DI;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class Controller
 * @package Core\Services\Routing
 */
class Controller
{
    /**
     * @var string - макет для использования
     */
    public static string $layout = 'layout';

    /**
     * @var array - массив data
     */
    public static array $data = [];

    public static object $module;

    public static array $language;

    /**
     * Конструктор контроллера
     */
    public static function load(): void
    {
        /**
         * Информация о подключенном модуле
         */
        $module = new Router();
        $module = $module::module();
        $themeDir = DI::instance()->get('theme')->themeDir . $module->module;

        self::$language = [
            'content'      => Language::moduleLanguage(),
            'uri'      => Language::moduleLanguage(),
            'client'       => Client::$language,
        ];


        $module->theme = [
            'dir'  => $themeDir . DIRECTORY_SEPARATOR . DI::instance()->get('theme')->use[$module->module],
            'name'  => DI::instance()->get('theme')->use[$module->module],
            'public'          => DI::instance()->get('theme')->themes[$module->module][DI::instance()->get('theme')->use[$module->module]]['resources']['public'],
        ];


        DI::instance()->set(['module', 'this'], $module);

        self::setData('module', $module);
    }

    /**
     * Массив $this->data для передачи данных из контроллера
     * в View файл
     *
     * @param string $key
     * @param mixed $value
     */
    final public static function setData(string $key, mixed $value): void
    {
        self::$data[$key] = $value;
    }
}
