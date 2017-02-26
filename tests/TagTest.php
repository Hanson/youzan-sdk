<?php


namespace Hanson\Youzan\Tests;


class TagTest extends YouzanBaseTest
{

    public function testAdd()
    {
        $result = $this->app->tag->add('test tag');

        print_r($result);

        $this->assertEquals('test tag', $result['name']);
    }

    public function testUpdate()
    {
        $result = $this->app->tag->update([
            'tag_id' => '94607756',
            'name' => 'update tag'
        ]);

        print_r($result);

        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $result = $this->app->tag->delete('94607756');

        print_r($result);

        $this->assertTrue($result);
    }

    public function testPaginate()
    {
        $result = $this->app->tag->paginate();

        print_r($result);

        $this->assertTrue(is_array($result));
    }

    public function testGet()
    {
        $result = $this->app->tag->get();

        print_r($result);

        $this->assertTrue(is_array($result->toArray()));
    }

    public function testGetCategories()
    {
        $result = $this->app->tag->getCategories();

        print_r($result);

        $this->assertTrue(is_array($result->toArray()));
    }

}