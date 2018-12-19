<?php


namespace Hanson\Youzan\Oauth;


use Hanson\Youzan\Youzan;

class Oauth
{

    /**
     * @var Youzan
     */
    private $app;

    public function __construct(Youzan $app)
    {
        $this->app = $app;
    }

    /**
     * @param $token
     * @return Youzan
     */
    public function createAuthorization($token)
    {
        $accessToken = new AccessToken(
            $this->app->getConfig()['client_id'],
            $this->app->getConfig()['client_secret']
        );

        $accessToken->setToken($token);

        $this->app->access_token = $accessToken;

        return $this->app;
    }

    /**
     * 根据 kdt id 创建授权应用
     *
     * @param $kdtId
     * @param array $token
     * @return Youzan
     */
    public function createAuthorizationWithKdtId($kdtId, array $token = [])
    {
        $accessToken = new AccessToken(
            $this->app->getConfig()['client_id'],
            $this->app->getConfig()['client_secret'],
            $kdtId
        );

        if ($token) {
            $accessToken->setToken($token['access_token'], $token['expires_in']);
        }

        $this->app->access_token = $accessToken;

        return $this->app;
    }

}