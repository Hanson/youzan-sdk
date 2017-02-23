<?php

class AccessTokenTest extends \PHPUnit\Framework\TestCase
{

    public function testSign()
    {
        $app = new \Hanson\Youzan\Foundation\Application([
            'app_id' => 'd2ab9514a1595cfb06',
            'secret' => '8b24c5f85f4c6a119a417898e9798338'
        ]);

        print_r($app->access_token->signatureParam('test', []));
    }
}