<?php


namespace Hanson\Youzan;


use Hanson\Foundation\AbstractAccessToken;
use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    const API = 'https://open.youzan.com/api/oauthentry/';

    /**
     * @var Youzan
     */
    protected $youzan;

    public function __construct(Youzan $youzan)
    {
        $this->youzan = $youzan;
    }

    /**
     * 请求API
     *
     * @param $method
     * @param array $params
     * @param array $files
     * @return array
     * @throws YouzanException
     */
    public function request($method, $params = [], $files = [])
    {
        $url = $this->url($method);

        $http = $this->getHttp();

        $params['access_token'] = $this->youzan['access_token']->getToken();

        $response = $files ? $http->upload($url, $params, $this->files($files)) : $http->post($url, $params);

        $result = json_decode(strval($response->getBody()), true);

        if (isset($result['error_response'])) {
            return $this->errorResponse($result);
        }

        return $result['response'] ? Helper::toNull($result['response']) : $result['response'];
    }

    private function files(array &$files)
    {
        foreach ($files as $name => &$path) {
            if (is_array($path)){
                foreach ($path as &$item) {
                    $item = ['contents' => $item, 'filename' => 'example'];
                }
            }else{
                $item = ['contents' => $path, 'filename' => 'example'];
            }
        }

        return $files;
    }

    public function errorResponse(array $result)
    {
        if ($this->youzan->getResponse()) {
            return $result['error_response'];
        } else {
            // 有赞有些接口中返回的错误信息包含在msg里，有的返回message属性中。
            $message = isset($result['error_response']['msg'])
                ? $result['error_response']['msg']
                : $result['error_response']['message'];

            throw new YouzanException($message, $result['error_response']['code']);
        }
    }

    /**
     * 生成接口 URI
     *
     * @param $method
     * @param $version
     * @return string
     * @throws YouzanException
     */
    private function url($method)
    {
        $methodArray = explode('.', $method);

        $method = '/' . $this->youzan->getVersion() . '/' . $methodArray[count($methodArray) - 1];

        array_pop($methodArray);

        return self::API . implode('.', $methodArray) . $method;
    }
}
