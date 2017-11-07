<?php


namespace Hanson\Youzan\Sso;


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
        $pimple['sso_api'] = function ($pimple) {
            return new Api($pimple);
        };
        $pimple['app_auth'] = function ($pimple) {
            return new AppAuth($pimple);
        };
    }
}