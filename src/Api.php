<?php


namespace Hanson\Youzan;


use Hanson\Foundation\AbstractAccessToken;
use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{

    /**
     * @var AccessToken
     */
    protected $accessToken;

    const API = 'https://open.youzan.com/api/oauthentry/';

    public function __construct(AbstractAccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * 请求API
     *
     * @param $method
     * @param array $params
     * @param string $version
     * @param array $files
     * @return string
     * @throws YouzanException
     */
    public function request($method, $params = [], $version = '3.0.0', $files = [])
    {
        $url = $this->url($method, $version);

        $http = $this->getHttp();

        $params['access_token'] = $this->accessToken->getToken();

        $response = $files ? $http->upload($url, $params, $files) : $http->post($url, $params);

        $result = json_decode(strval($response->getBody()), true);

        if (isset($result['error_response'])) {
            throw new YouzanException($result['error_response']['msg'], $result['error_response']['code']);
        }

        return $result;
    }

    /**
     * 生成接口 URI
     *
     * @param $method
     * @param $version
     * @return string
     */
    private function url($method, $version)
    {
        $methodArray = explode('.', $method);

        $method = '/' . $version . '/' . $methodArray[count($methodArray) - 1];

        array_pop($methodArray);

        return self::API . implode('.', $methodArray) . $method;
    }

    /**
     * Push guzzle middleware before request.
     *
     * @return mixed
     */
    public function middlewares()
    {
    }
}