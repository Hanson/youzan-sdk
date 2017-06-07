<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2017/2/22
 * Time: 22:40
 */

namespace Hanson\Youzan\Core;


use Doctrine\Common\Cache\Cache;

class AccessToken
{
    public $appId;

    public $secret;

    /**
     * Constructor
     *
     * @param string                       $appId
     * @param string                       $secret
     * @param \Doctrine\Common\Cache\Cache $cache
     */
    public function __construct($appId, $secret, Cache $cache = null)
    {
        $this->appId = $appId;
        $this->secret = $secret;
        $this->cache = $cache;
    }

    public function signature($params)
    {
        ksort($params);

        $text = '';
        foreach ($params as $key => $value) {
            $text .= $key . $value;
        }

        return md5($this->secret . $text . $this->secret);
    }

    public function signatureParam($method, $args, $version = '1.0')
    {
        $params = [
            'app_id' => $this->appId,
            'method' => $method,
            'timestamp' => date('Y-m-d H:i:s'),
            'v' => $version,
        ];

        $args = array_merge($args, $params);

        $args['sign'] = $this->signature($args);

        return $args;
    }

}