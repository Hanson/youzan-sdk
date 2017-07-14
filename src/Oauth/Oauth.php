<?php


namespace Hanson\Youzan\Oauth;


class Oauth extends Api
{

    const AUTHORIZE_API = 'https://open.youzan.com/oauth/authorize?';


    /**
     * 重定向至授权 URL.
     *
     * @param $state
     * @param null $scope
     */
    public function authorizationRedirect($state = '', $scope = null)
    {
        $url = $this->authorizationUrl($state, $scope);

        header('Location:'.$url);
    }

    /**
     * 获取授权URL.
     *
     * @param string $state
     * @param null $scope
     * @return string
     */
    public function authorizationUrl($state = '', $scope = null)
    {
        return self::AUTHORIZE_API . http_build_query([
            'client_id' => $this->accessToken->getClientId(),
            'response_type' => 'code',
            'state' => $state,
            'redirect_uri' => $this->accessToken->getRedirectUri(),
            'scope' => $scope
        ]);
    }

    /**
     * 获取 access token
     *
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken->token([
            'client_id' => $this->accessToken->getClientId(),
            'client_secret' => $this->accessToken->getSecret(),
            'grant_type' => 'authorization_code',
            'code' => $this->accessToken->getRequest()->get('code'),
            'redirect_uri' => $this->accessToken->getRedirectUri()
        ]);
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
        return $this->accessToken->token([
            'client_id' => $this->accessToken->getClientId(),
            'client_secret' => $this->accessToken->getSecret(),
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'scope' => $scope
        ]);
    }

}