<?php

namespace Hanson\Youzan\Tests;

class ProductTest extends YouzanBaseTest
{
    
    public function testAdd()
    {
        $result = $this->app->product->add([
            'title' => 'test' . rand(),
            'price' => rand(),
            'post_fee' => '0',
            'sku_outer_ids' => '123,124',
            'sku_prices' => '3.00,40000.00',
            'sku_quantities' => '3,4',
            'sku_properties' => '颜色:黄色;尺寸:M,颜色:黄色;尺寸:S'
        ], [
            'images' => [
                __DIR__ . '/img/head.jpg',
                __DIR__ . '/img/gcu.jpg',
            ]
        ]);

        $this->assertNotNull($result['num_iid']);

//        $result = $this->app->product->add([
//            'title' => 'test' . rand(),
//            'price' => rand(),
//            'post_fee' => '0',
//        ], [
//            'images[]' => __DIR__ . '/img/gcu.jpg',
//        ]);
//
//        $this->assertFalse(is_null($result));

        return $result;
    }

    /**
     * @param array $product
     * @return mixed
     * @depends testAdd
     */
    public function testUpdate(array $product)
    {
        $result = $this->app->product->update([
            'num_iid' => $product['num_iid'],
            'outer_id' => '123rsdf',
            'title' => 'ahahahahah'
        ]);

        print_r($result);

        $this->assertEquals($product['num_iid'], $result['num_iid']);

        return $result;
    }

    /**
     * @param array $product
     * @return mixed
     * @depends testUpdate
     */
    public function testDelisting(array $product)
    {
        $result = $this->app->product->delisting([
            'num_iid' => $product['num_iid']
        ]);

        $this->assertEquals($product['num_iid'], $result['num_iid']);

        return $result;
    }

    /**
     * @param array $product
     * @return mixed
     * @depends testDelisting
     */
    public function testListing(array $product)
    {
        $result = $this->app->product->listing([
            'num_iid' => $product['num_iid']
        ]);

        $this->assertEquals($product['num_iid'], $result['num_iid']);

        return $result;
    }

    public function testGet()
    {
        $result = $this->app->product->get([
            'outer_id' => '123'
        ]);

        print_r($result->pluck('num_iid'));

        $this->assertEquals($result[0]['outer_id'], 123);

        return $result;
    }

    public function testGeDelisting()
    {
        $result = $this->app->product->getDelisting([
            'q' => 'update'
        ]);

        print_r($result->pluck('num_iid'));

        $this->assertTrue(is_array($result->toArray()));
    }

    public function testGetListing()
    {
        $result = $this->app->product->getListing([
            'q' => 'update'
        ]);

        print_r($result->pluck('num_iid'));

        $this->assertTrue(is_array($result->toArray()));
    }

    public function testBatchListing()
    {
        $result = $this->app->product->batchListing([
            'num_iids' => '327358847,327589695'
        ]);

        $this->assertTrue($result);
    }

    public function testBatchDelisting()
    {
        $result = $this->app->product->batchDelisting([
            'num_iids' => '327358847,327589695'
        ]);

        $this->assertTrue($result);
    }

    public function testFind()
    {
        $result = $this->app->product->find([
            'num_iid' => '327803086'
        ]);

        $this->assertEquals($result['num_iid'], '327803086');
    }

    public function testGetSku()
    {
        $result = $this->app->product->getSku([
            'num_iid' => '327803086',
            'outer_id' => '124'
        ]);

        $this->assertEquals($result[0]['num_iid'], '327803086');
    }

    public function testUpdateSku()
    {
        $result = $this->app->product->updateSku([
            'num_iid' => '327803086',
            'sku_id' => '36125593',
            'price' => '1000.00'
        ]);

        $this->assertEquals($result['price'], '1000.00');
    }

    public function testDelete()
    {
        $result = $this->app->product->delete('327358934');

        $this->assertTrue($result);
    }

}
