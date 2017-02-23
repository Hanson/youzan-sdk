<?php


class ProductTest extends \PHPUnit\Framework\TestCase 
{

    /**
     * @var \Hanson\Youzan\Foundation\Application
     */
    public $app;

    public function __construct()
    {
        parent::__construct();

        $this->app = new \Hanson\Youzan\Foundation\Application([
            'app_id' => 'd2ab9514a1595cfb06',
            'secret' => '8b24c5f85f4c6a119a417898e9798338'
        ]);
    }

    public function testAdd()
    {
        $result = $this->app->product->add([
            'title' => 'test',
            'price' => '0.01',
            'post_fee' => '0',
            'images' => [
                file_get_contents('https://avatars1.githubusercontent.com/u/10583423?v=3&s=460')
            ]
        ]);
        print_r($result);
    }

}
