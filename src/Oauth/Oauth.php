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

}