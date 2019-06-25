<?php


namespace Hanson\Youzan;


use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    const API = 'https://open.youzanyun.com/api/';

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
     */
    public function request($method, $params = [], $files = [])
    {
        $url = $this->url($method);

        $http = $this->getHttp();

        $url = $url .'?' . http_build_query(['access_token' => $this->youzan['access_token']->getToken()]);

        $response = $files ? $http->upload($url, $params, $this->files($files)) : $http->json($url, $params);

        $result = json_decode(strval($response->getBody()), true);

        if (isset($result['gw_err_resp'])) {
            return $this->errorResponse($result);
        }

        return $result ? Helper::toNull($result) : $result;
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
            return $result;
        } else {
            // 有赞有些接口中返回的错误信息包含在msg里，有的返回message属性中。
            $message = isset($result['gw_err_resp']['err_msg'])
                ? $result['gw_err_resp']['err_msg']
                : $result['gw_err_resp']['err_message'];

            throw new YouzanException($message, $result['gw_err_resp']['err_code']);
        }
    }

    /**
     * 生成接口 URI
     *
     * @param $method
     * @return string
     * @throws YouzanException
     */
    private function url($method)
    {
        return self::API . $method . '/' . $this->youzan->getVersion();
    }
}
