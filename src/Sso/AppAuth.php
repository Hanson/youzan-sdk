<?php


namespace Hanson\Youzan\Sso;


use Hanson\Youzan\Youzan;

class AppAuth
{

    /**
     * @var Youzan
     */
    private $app;

    public function __construct(Youzan $youzan)
    {
        $this->app = $youzan;
    }

    public function initToken()
    {
        return $this->app->sso_api->request('initToken');
    }

    public function login($open_user_id, $params = [])
    {
        $params['open_user_id'] = $open_user_id;
        return $this->app->sso_api->request('login', $params);
    }

    public function logout($open_user_id)
    {
        return $this->app->sso_api->request('logout', compact('open_user_id'));
    }

}