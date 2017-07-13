<?php


namespace Hanson\Youzan\Personal;


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
        $pimple['access_token'] = function ($pimple) {
            return new AccessToken($pimple['config']['client_id'], $pimple['config']['client_secret'], $pimple['config']['kdt_id']);
        };
    }
}