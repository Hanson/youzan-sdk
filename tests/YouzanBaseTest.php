<?php

namespace Hanson\Youzan\Tests;

use Hanson\Youzan\Foundation\Application;
use PHPUnit\Framework\TestCase;

class YouzanBaseTest extends TestCase
{
    /**
     * @var Application
     */
    public $app;

    public function __construct()
    {
        parent::__construct();

        $this->app = new Application([
            'app_id' => '2c61af3095a3518214',
            'secret' => '0ee9bfdeced099f98ad0c714f365fc0f'
        ]);
    }

}
