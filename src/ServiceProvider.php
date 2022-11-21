<?php


namespace Hanson\Youzan;


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
        $pimple['access_token'] = function (Youzan $pimple) {
            return new AccessToken($pimple);
        };

        $pimple['api'] = function (Youzan $pimple) {
            return new Api($pimple);
        };

        $pimple['push'] = function (Youzan $pimple) {
            return new Push($pimple);
        };

    }
}