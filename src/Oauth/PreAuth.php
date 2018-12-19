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

    /**
     * @return AccessToken
     */
    private function accessToken()
    {
        return $this->youzan['oauth.access_token'];
    }

    /**
     * 获取授权URL.
     *
     * @param string $state
     * @param null $scope
     * @return string
     */
    public function authorizationUrl($state = 'state', $scope = null)
    {
        return self::AUTHORIZE_API . http_build_query([
            'client_id' => $this->accessToken()->getClientId(),
            'response_type' => 'code',
            'state' => $state,
            'redirect_uri' => $this->accessToken()->getRedirectUri(),
            'scope' => $scope
        ]);
    }

    /**
     * 获取 access token
     *
     * @param null $code
     * @return mixed
     */
    public function getAccessToken($code = null)
    {
        $token = $this->accessToken()->token([
            'client_id' => $this->accessToken()->getClientId(),
            'client_secret' => $this->accessToken()->getSecret(),
            'grant_type' => 'authorization_code',
            'code' => $code ?? $this->accessToken()->getRequest()->get('code'),
            'redirect_uri' => $this->accessToken()->getRedirectUri()
        ]);

        $this->cacheToken($token);

        return $token;
    }

    /**
     * 刷新令牌
     *
     * @param $refreshToken
     * @param null $scope
     * @return mixed
     */
    public function refreshToken($refreshToken, $scope = null)
    {
        $token = $this->accessToken()->token([
            'client_id' => $this->accessToken()->getClientId(),
            'client_secret' => $this->accessToken()->getSecret(),
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'scope' => $scope
        ]);

        $this->cacheToken($token);

        return $token;
    }

    /**
     * 当 token 有效时缓存授权 token
     *
     * @param array $token
     */
    protected function cacheToken(array $token)
    {
        if (isset($token['access_token'])) {
            $result = $this->youzan->oauth->createAuthorization($token['access_token'])->setVersion('3.0.0')->request('youzan.shop.get');

            $this->youzan->oauth->createAuthorizationWithKdtId($result['id'], $token);
        }
    }

}