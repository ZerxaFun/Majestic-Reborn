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


namespace Core\Services\Database;


use PDO;
use PDOException;


/**
 * Конструктор запросов к базе данных SQL
 *
 * Class Statement
 * @package Run\Database
 */
class Statement
{

    /**
     * SQL запрос
     *
     * @var string
     */
    protected string $sql = '';

    /**
     * PDO statement
     *
     * @var object
     */
    protected object $stmt;

    /**
     * Statement конструктор.
     *
     * @param string $sql
     */
    public function __construct(string $sql = '')
    {
        /**
         * Если @sql запрос не пуст, то вызываем $this->prepare() и передаем запрос
         */
        if ($sql !== '') {
            $this->prepare($sql);
        }
    }

    /**
     * Подготовка оператора SQL.
     *
     * @param  string  $sql.
     * @return Statement
     */
    public function prepare(string $sql): Statement
    {
        /**
         * Подготовка отправки запроса
         */
        $this->stmt = Database::connection()->prepare($this->sql = $sql);


        /**
         * Возвращение результата
         */
        return $this;
    }

    /**
     * Привязка параметра к значению
     *
     * $type - тип подключения и типа базы данных, на данный момент
     * не используется, создано для будущего использования других
     * типов баз данных
     *
     * @param $parameter
     * @param $value
     * @param int $type
     * @return Statement
     */
    public function bind($parameter, $value, int $type = 0): Statement
    {
        /**
         * Определение типа подключения к базе данных
         * 0 - MySQL
         */
        if ($type === 0) {
            $type = match (strtolower(gettype($value))) {
                'integer' => PDO::PARAM_INT,
                'boolean' => PDO::PARAM_BOOL,
                'null' => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }

        /**
         * Привязка значения
         */
        $this->stmt->bindValue($parameter, $value, $type);

        /**
         * Возвращение класса
         */
        return $this;
    }

    /**
     * Подключение к базе данных и вывод ошибки
     *
     * @return mixed
     */
    public function execute()
    {
        try {
            return $this->stmt->execute();
        } catch (PDOException $error) {

            echo '<h1>MySQL Error</h1>';
            echo '<p>' . $error->errorInfo[2] . '</p>';
            echo '<h3>Last Query</h3>';
            echo '<p>' . $this->sql . '</p>';
            exit;

        }
    }

    /**
     * Получение одного результата.
     *
     * @return object|bool
     */
    public function fetch()
    {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Получение всех результатов.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Получение результата по номеру.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Возвращаение ошибки при SQL запросе.
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->stmt->errorInfo();
    }
}
