<?php


namespace Core\Services\Routing;


use Core\Services\Http\Header;

class APIController
{
    /**
     * @var array - массив data
     */
    public array $data = [];
    public array $nuxt = [];

    /**
     * @param int $status_code
     * @param array $error
     * @param array $result
     * @param array $nuxt
     * @throws \JsonException
     */
    public function setData(int $status_code = 200, array $error = [], array $result = [], array $nuxt = []): void
    {
        (new Header())->header('json');

        $this->data['result'] = $result;
        $this->data['error'] = $error;
        $this->data['code'] = $status_code;
        $this->nuxt = $nuxt;

        echo json_encode($this->data, JSON_THROW_ON_ERROR);
    }
}
