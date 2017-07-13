<?php


namespace Hanson\Youzan;


use Hanson\Foundation\Foundation;

/**
 * Class Youzan
 * @package Hanson\Youzan
 *
 * @property \Hanson\Youzan\Api   $api
 */
class Youzan extends Foundation
{

    const PERSONAL = 'PERSONAL';

    const PLATFORM = 'PLATFORM';

    public function __construct($config)
    {
        switch ($config['type']) {
            case self::PERSONAL:
                $this->providers[] = Personal\ServiceProvider::class;
                break;
            case self::PLATFORM:
                $this->providers[] = Platform\ServiceProvider::class;
                break;
        }

        parent::__construct($config);

        $this->api = new Api($this['access_token']);
    }

    /**
     * @param $shopId
     * @return $this
     */
    public function setShopId($shopId)
    {
        $this['access_token']->setShopId($shopId);

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