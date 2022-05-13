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


use Core\Services\Client\Client;
use Core\Services\Routing\Modules\Language;
use DI;

/**
 * Class AbstractController
 * @package Core\Services\Routing
 */
abstract class AbstractController
{
    /**
     * @var string - макет для использования
     */
    public string $layout = 'layout';

    /**
     * @var array - массив data
     */
    public array $data = [];

    public object $module;

    public array $language;

    /**
     * Конструктор контроллера
     */
    public function __construct()
    {
        /**
         * Информация о подключенном модуле
         */
        $module = new Router();
        $module = $module::module();
        $themeDir = DI::instance()->get('theme')->themeDir . $module->module;

        $this->language = [
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

        $this->setData('module', $module);
dd($this);
    }
}
