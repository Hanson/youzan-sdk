<?php


namespace Hanson\Youzan;


use Hanson\Foundation\Foundation;

/**
 * Class Youzan
 * @package Hanson\Youzan
 *
 * @property \Hanson\Youzan\Api   $api
 * @property \Hanson\Youzan\AccessToken     $access_token
 * @property \Hanson\Youzan\Oauth\PreAuth   $pre_auth
 * @property \Hanson\Youzan\Oauth\Oauth     $oauth
 */
class Youzan extends Foundation
{

    const PERSONAL = 'PERSONAL';

    const PLATFORM = 'PLATFORM';

    protected $providers = [
        ServiceProvider::class,
        Oauth\ServiceProvider::class
    ];

    /**
     * @param $kdtId
     * @return Youzan
     */
    public function setKdtId($kdtId)
    {
        $this->access_token->setKdtId($kdtId);

        return $this;
    }

    /**
     * API请求
     *
     * @param $method
     * @param array $params
     * @param string $version
     * @param array $files
     * @return string
     */
    public function request($method, $params = [], $version = '3.0.0', $files = [])
    {
        return $this->api->request($method, $params, $version, $files);
    }
}