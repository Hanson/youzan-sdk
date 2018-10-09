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
        $pimple['access_token'] = function ($pimple) {
            $accessToken = new AccessToken(
                $pimple['config']['client_id'],
                $pimple['config']['client_secret'],
                $pimple['config']['kdt_id']
            );

            return $accessToken;
        };

        $pimple['api'] = function ($pimple) {
            return new Api($pimple);
        };

        $pimple['push'] = function ($pimple) {
            return new Push(
                $pimple['config']['client_id'],
                $pimple['config']['client_secret'],
                $pimple['request']
            );
        };

    }
}