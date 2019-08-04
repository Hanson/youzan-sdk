<?php

namespace Hanson\Youzan\App;

/**
 * 详细 API 文档请前往 ->  https://www.youzanyun.com/docs/guide/appsdk/683.
 *
 * Class Sso
 */
class Sso extends Api
{
    /**
     * 初始化 token.
     *
     * @throws \Hanson\Youzan\YouzanException
     *
     * @return mixed
     */
    public function initToken()
    {
        return $this->request('initToken');
    }

    /**
     * 登录.
     *
     * @param $open_user_id
     * @param array $params
     *
     * @throws \Hanson\Youzan\YouzanException
     *
     * @return mixed
     */
    public function login($open_user_id, $params = [])
    {
        $params['open_user_id'] = $open_user_id;

        return $this->request('login', $params);
    }

    /**
     * 注销登录.
     *
     * @param $open_user_id
     *
     * @throws \Hanson\Youzan\YouzanException
     *
     * @return mixed
     */
    public function logout($open_user_id)
    {
        return $this->request('logout', compact('open_user_id'));
    }
}
