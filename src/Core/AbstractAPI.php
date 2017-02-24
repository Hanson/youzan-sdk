<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2017/2/22
 * Time: 22:40
 */

namespace Hanson\Youzan\Core;


use Hanson\Youzan\Core\Exceptions\HttpException;
use Illuminate\Support\Collection;

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
     * The Api version
     *
     * @var string
     */
    protected $version = '1.0';

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
     * Parse JSON from response and check error.
     *
     * @param string $method
     * @param $api
     * @param array $args
     * @return mixed
     */
    public function parseJSON($method, $api, array $args)
    {
        $http = $this->getHttp();

        $args[1] = $this->accessToken->signatureParam($api, $args[1], $this->version);

        $result = json_decode(call_user_func_array([$http, $method], $args), true);

        $this->checkAndThrow($result);

        return $result;
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
     * Check the array data errors, and Throw exception when the contents contains error.
     *
     * @param array $content
     * @throws HttpException
     */
    protected function checkAndThrow(array $content)
    {
        if (isset($content['error_response'])) {
            throw new HttpException($content['error_response']['msg'], $content['error_response']['code']);
        }
    }

    /**
     * set the api version
     *
     * @param $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }
}