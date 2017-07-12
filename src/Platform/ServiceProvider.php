<?php


namespace Hanson\Youzan\Platform;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
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
        $pimple['platform.access_token'] = function ($pimple) {
            return new AccessToken($pimple['config']['client_id'], $pimple['config']['client_secret']);
        };

        $pimple['platform'] = function ($pimple) {
            return new Platform($pimple['platform.access_token']);
        };
    }
}