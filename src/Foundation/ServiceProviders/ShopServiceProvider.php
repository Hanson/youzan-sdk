<?php
/**
 * Created by PhpStorm.
 * User: kelaocai
 * Date: 2017/6/4
 * Time: 16:43
 */

namespace Hanson\Youzan\Foundation\ServiceProviders;


use Hanson\Youzan\Shop\Shop;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ShopServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['shop']=function ($pimple){
            return new Shop($pimple['access_token']);
        };
    }
}