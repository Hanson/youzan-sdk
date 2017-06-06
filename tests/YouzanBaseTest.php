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
            'app_id' => '',
            'secret' => ''
        ]);
    }

}
