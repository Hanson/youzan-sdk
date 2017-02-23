<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2017/2/22
 * Time: 22:40
 */

namespace Hanson\Youzan\Core;


use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;

class AbstractAPI
{
    /**
     * Http instance.
     *
     * @var Http
     */
    protected $http;

    /**
     * The request token.
     *
     * @var AccessToken
     */
    protected $accessToken;

    /**
     * Constructor.
     *
     * @param AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->setAccessToken($accessToken);
    }

    /**
     * Set the request token.
     *
     * @param AccessToken $accessToken
     *
     * @return $this
     */
    public function setAccessToken(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * Return the http instance.
     *
     * @return Http
     */
    public function getHttp()
    {
        if (is_null($this->http)) {
            $this->http = new Http();
        }

        return $this->http;
    }

    /**
     * Parse JSON from response and check error.
     *
     * @param $api
     * @param $url
     * @param $params
     * @param string $method
     * @param string $version
     * @return mixed
     * @internal param array $args
     */
    public function parseJSON($method, $api, $url, $params, $version = '1.0')
    {
        $http = $this->getHttp();

        $params = $this->accessToken->signatureParam($api, $params, $version);

        $result = call_user_func_array([$http, $method], [$url, $params]);

        return json_decode($result, true);
    }
}