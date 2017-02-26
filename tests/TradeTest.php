<?php


namespace Hanson\Youzan\Tests;


class TradeTest extends YouzanBaseTest
{

    public function testUpdateMemo()
    {
        $result = $this->app->trade->updateMemo([
            'tid' => 'E20170226142018070961857',
            'memo' => 'test youzan',
            'flag' => 3
        ]);

        print_r($result);

        $this->assertEquals($result['trade_memo'], 'test youzan');
    }

    public function testGet()
    {
        $result = $this->app->trade->get();

        print_r($result['trades'][1]);

        $this->assertTrue(isset($result['total_results']));
    }

    public function testSignClose()
    {
        $result = $this->app->trade->signClose('E20170226144959070965183');

        print_r($result);
    }

    public function testSignRefund()
    {
        $result = $this->app->trade->signRefund([
            'tid' => 'E20170226144959070965183',
            'refund_amt' => '0.01',
            'oid' => '17944499'
        ]);

        print_r($result);
    }

}
