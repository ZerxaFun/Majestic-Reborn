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


namespace Core\Services\Http;


use Core\Define;

/**
 * Класс для работы с URL
 *
 * Class Uri
 * @package Core\Services\Http
 */
class Uri
{
    /**
     * Базовый URL пользователя
     *
     * @var string
     */
    protected static string $base = '';

    /**
     * Активный URL пользователя
     *
     * @var string
     */
    protected static string $uri = '';

    /**
     * Получение сегментов URL в виде массива
     * @var array
     */
    protected static array $segments = [];

    /**
     * Инициализируйте класс URI.
     *
     * @return void
     */
    public static function initialize(): void
    {

		# Нам нужно получить различные разделы из URI для обработки
		# правильный маршрут.
       # header('X-Powered-By: ' . Define::NAME_HEAD);
        # Стандартный запрос в браузере?
        if (isset($_SERVER['REQUEST_URI'])) {
            # Получить активный URI.
            $request    = $_SERVER['REQUEST_URI'];
            $host       = $_SERVER['HTTP_HOST'];
            $protocol   = 'http' . (Request::https() ? 's' : '');
            $base       = $protocol . '://' . $host;
            $uri        = $base . $request;

            # Создаем сегменты URI.
            $length     = strlen($base);
            $str        = (string) substr($uri, $length);
            $arr        = explode('/', trim($str, '/'));
            $segments   = [];

            foreach ($arr as $segment) {
                if ($segment !== '') {
                    $segments[] = $segment;
                }
            }

           # Назначаем свойства.
            static::$base       = $base;
            static::$uri        = $uri;
            static::$segments   = $segments;
        } else if (isset($_SERVER['argv'])) {
            $segments = [];
            foreach ($_SERVER['argv'] as $arg) {
                if ($arg !== $_SERVER['SCRIPT_NAME']) {
                    $segments[] = $arg;
                }
            }

            static::$segments = $segments;
        }

    }

    public static function backSegment()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    public static function segmentLast()
    {
        return  array_pop(static::$segments);
    }

    /**
     * Получить базовый URI.
     *
     * @return string
     */
    public static function base(): string
	{
        return static::$base;
    }

    /**
     * Получение текущего URL
     *
     * @return string
     */
    public static function uri(): string
    {
        return static::$uri;
    }

    /**
     * Получите сегменты URI.
     *
     * @return array
     */
    public static function segments(): array
	{
        return static::$segments;
    }

    /**
     * Возвращает URL встроенного сайта.
     *
     * @param  string  $uri - URI для добавления на базу.
     * @return string
     */
    public function url(string $uri = ''): string
	{
        return static::base() . ltrim($uri, '/');
    }

    /**
     * Получает сегмент из URI.
     *
     * @param  int  $num - Номер сегмента.
     * @return string
     */
    public static function segment(int $num): string
	{
        /**
         * Нормализация номера сегмента
         */
        --$num;

        /**
         * Попытка найти запрошенный сегмент
         */
        return static::$segments[$num] ?? '';
    }

    /**
     * Получить сегменты URI в виде строки.
     *
     * @return string
     */
    public static function segmentString(): string
	{
        return implode('/', static::$segments);
    }
}
