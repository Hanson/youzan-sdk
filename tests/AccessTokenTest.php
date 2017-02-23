<?php

namespace Hanson\Youzan\Tests;

class AccessTokenTest extends YouzanBaseTest
{

    public function testSign()
    {
        print_r($this->app->access_token->signatureParam('test', []));
    }
}