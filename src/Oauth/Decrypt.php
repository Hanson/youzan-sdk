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

    public function decrypt($data)
    {
        return openssl_decrypt(urldecode(urldecode($data)), 'AES-128-CBC', substr($this->app->getConfig()['client_secret'], 0, 16), null, '0102030405060708');
    }

}