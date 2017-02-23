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

    /**
     * @param array $product
     * @return mixed
     * @depends testListing
     */
    public function testGet(array $product)
    {
        $result = $this->app->product->get([
            'outer_id' => '123'
        ]);
        print_r($result);

//        $this->assertEquals($result[0]['num_iid'], $product['num_iid']);


        return $result;
    }

}
