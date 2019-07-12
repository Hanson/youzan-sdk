<?php

namespace Hanson\Youzan\Oauth;

use Hanson\Youzan\Youzan;

class Decrypt
{
    private $app;

    public function __construct(Youzan $app)
    {
        $this->app = $app;
    }

    /**
     * 解密消息
     *
     * @param $data
     * @return mixed
     */
    public function decrypt($data)
    {
        $data = openssl_decrypt(urldecode($data), 'AES-128-CBC', substr($this->app->getConfig()['client_secret'], 0, 16), null, '0102030405060708');

        if ($data) {
            return json_decode($data, true);
        }
    }

}