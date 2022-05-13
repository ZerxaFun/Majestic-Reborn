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


/**
 * Class Controller
 * @package Core\Services\Routing
 */
class Controller extends AbstractController
{
    public function data(): void
    {
        $this->construct();
    }
    /**
     * Массив $this->data для передачи данных из контроллера
     * в View файл
     *
     * @param string $key
     * @param mixed $value
     */
    final public function setData(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }
}
