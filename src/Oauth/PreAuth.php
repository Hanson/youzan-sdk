<?php

namespace Hanson\Youzan\Oauth;

use Hanson\Youzan\Api;

class PreAuth extends Api
{
    const AUTHORIZE_API = 'https://open.youzan.com/oauth/authorize?';

    /**
     * 重定向至授权 URL.
     *
     * @param $state
     * @param null $scope
     */
    public function authorizationRedirect($state = 'state', $scope = null)
    {
        $url = $this->authorizationUrl($state, $scope);

        header('Location:'.$url);
    }

    private function accessToken()
    {
        return $this->youzan['oauth.access_token'];
    }

    /**
     * 获取授权URL.
     *
     * @param string $state
     * @param null   $scope
     *
     * @return string
     */
    public function authorizationUrl($state = 'state', $scope = null)
    {
        return self::AUTHORIZE_API.http_build_query([
            'client_id'     => $this->accessToken()->getClientId(),
            'response_type' => 'code',
            'state'         => $state,
            'redirect_uri'  => $this->accessToken()->getRedirectUri(),
            'scope'         => $scope,
        ]);
    }

    /**
     * 获取 access token.
     *
     * @param null $code
     *
     * @return mixed
     */
    public function getAccessToken($code = null)
    {
        return $this->accessToken()->token([
            'client_id'      => $this->accessToken()->getClientId(),
            'client_secret'  => $this->accessToken()->getSecret(),
            'authorize_type' => 'authorization_code',
            'code'           => $code ?? $this->accessToken()->getRequest()->get('code'),
            'redirect_uri'   => $this->accessToken()->getRedirectUri(),
        ]);
    }

    /**
     * 刷新令牌.
     *
     * @param $refreshToken
     * @param null $scope
     *
     * @return mixed
     */
    public function refreshToken($refreshToken, $scope = null)
    {
        return $this->accessToken()->token([
            'client_id'      => $this->accessToken()->getClientId(),
            'client_secret'  => $this->accessToken()->getSecret(),
            'authorize_type' => 'refresh_token',
            'refresh_token'  => $refreshToken,
            'scope'          => $scope,
        ]);
    }
}
