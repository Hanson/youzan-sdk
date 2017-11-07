<?php


namespace Hanson\Youzan\Sso;


use Hanson\Youzan\Youzan;
use Hanson\Youzan\YouzanException;
use Hanson\Foundation\AbstractAPI;


class Api extends AbstractAPI
{
    /**
     * @var Youzan
     */
    private $app;

    const API = 'https://uic.youzan.com/sso/open/';

    public function __construct(Youzan $youzan)
    {
        $this->app = $youzan;
    }

    /**
     * @param $method
     * @param array $params
     * @return mixed
     * @throws YouzanException
     */
    public function request($method, $params = [])
    {
        $httpClient = $this->getHttp();
        $params['client_id'] = $this->app['config']['client_id'];
        $params['client_secret'] = $this->app['config']['client_secret'];

        $response = $httpClient->post(Api::API . $method, $params);
        $result = json_decode(strval($response->getBody()), true);
        if (isset($result['error_response'])) {
            throw new YouzanException($result['error_response']['msg'], $result['error_response']['code']);
        }
        return $result;
    }

    public function middlewares()
    {
        // TODO: Implement middlewares() method.
    }

}