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
            'app_id' => '124286ccc1da10f3de',
            'secret' => 'd8715349e02f84ec3e1e9005ffc2485f'
        ]);
    }

}
