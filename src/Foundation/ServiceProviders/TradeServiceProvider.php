<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2017/2/22
 * Time: 22:34
 */

namespace Hanson\Youzan\Foundation\ServiceProviders;


use Hanson\Youzan\Trade\Trade;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class TradeServiceProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['trade'] = function ($pimple) {
            return new Trade($pimple['access_token']);
        };
    }
}