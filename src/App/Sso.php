<?php


namespace Hanson\Youzan\App;


use Hanson\Youzan\Youzan;

class Sso extends Api
{

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