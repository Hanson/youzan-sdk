<?php
/**
 * Created by PhpStorm.
 * User: kelaocai
 * Date: 2017/6/4
 * Time: 16:37
 */

namespace Hanson\Youzan\Tests;


class ShopTest extends YouzanBaseTest
{


    public function testGet()
    {
        $result = $this->app->shop->get();
        $this->assertEquals($result['id'], '2901');
    }

    public function testGetAddressList()
    {
        $result = $this->app->shop->getAddressList();
        $this->assertTrue(is_array($result->toArray()));
    }

    public function testCreateAddress()
    {
        $result = $this->app->shop->createAddress(
            [
                'address' => '科技园广场',
                'area' => '南山区',
                'city' => '深圳市',
                'contact_name' => 'baocai',
                'is_invoice' => '1',
                'is_invoice_default' => '0',
                'is_return' => '1',
                'is_return_default' => '1',
                'mobile' => '18888888888',
                'province' => '广东省',
                'region_id' => '518000',
            ]
        );
        $this->addressId=$result['id'];
        $this->assertEquals($result['is_success'], true);
    }

    public function testDeleteAddress()
    {
        $addList=$this->app->shop->getAddressList();
        if($addList['total']>0){
            $addId=$addList['list'][$addList['total']-1]['id'];
        }
        $result = $this->app->shop->deleteAddress($addId);
        $this->assertEquals($result['is_success'], true);
    }
    public function testGetAddress()
    {
        $addList=$this->app->shop->getAddressList();
        if($addList['total']>0){
            $addId=$addList['list'][$addList['total']-1]['id'];
        }
        $result = $this->app->shop->getAddress($addId);
        $this->assertEquals($result['id'], $addId);
    }

    public function testUpdateAddress(){

        $addList=$this->app->shop->getAddressList();
        if($addList['total']>0){
            $addId=$addList['list'][$addList['total']-1]['id'];
        }

        $result=$this->app->shop->updateAddress([
            'address'=>'地址更新测试',
            'area'=>'天河区',
            'city'=>'广州区',
            'contact_name'=>'baocai',
            'is_invoice'=>'1',
            'is_invoice_default'=>'0',
            'is_return'=>'1',
            'is_return_default'=>'1',
            'mobile'=>'18888888888',
            'province'=>'广东省',
            'region_id'=>'510000',
            'id'=>$addId,
        ]);

        $this->assertEquals($result['is_success'], true);
    }

}