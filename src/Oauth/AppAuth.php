<?php


namespace Hanson\Youzan\Oauth;


use Hanson\Youzan\Youzan;
use Hanson\Youzan\YouzanException;

class AppAuth
{

    /**
     * @var Youzan
     */
    private $app;

    const API = 'https://uic.youzan.com/sso/open/';

    public function __construct(Youzan $app)
    {
        $this->app = $app;
    }

    protected function request($method, array $params = [])
    {
        $httpClient = $this->app->api->getHttp();
        $params['client_id'] = $this->app['config']['client_id'];
        $params['client_secret'] = $this->app['config']['client_secret'];

        $response = $httpClient->post(AppAuth::API . $method, $params);
        $result = json_decode(strval($response->getBody()), true);
        if (isset($result['error_response'])) {
            throw new YouzanException($result['error_response']['msg'], $result['error_response']['code']);
        }
        return $result;
    }

    public function initToken()
    {
        return $this->request('initToken');
    }


    public function login($open_user_id, $params = [])
    {
        $params['open_user_id'] = $open_user_id;
        return $this->request('login', $params);
    }

    public function logout($open_user_id)
    {
        return $this->request('logout', compact('open_user_id'));
    }

}