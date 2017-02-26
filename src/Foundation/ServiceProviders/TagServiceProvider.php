<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2017/2/22
 * Time: 22:34
 */

namespace Hanson\Youzan\Foundation\ServiceProviders;


use Hanson\Youzan\Tag\Tag;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class TagServiceProvider implements ServiceProviderInterface
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
        $pimple['tag'] = function ($pimple) {
            return new Tag($pimple['access_token']);
        };
    }
}