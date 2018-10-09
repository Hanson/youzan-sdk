<?php


namespace Hanson\Youzan\Oauth;


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

        $pimple['oauth.access_token'] = function ($pimple) {
            $accessToken =  new AccessToken(
                $pimple['config']['client_id'],
                $pimple['config']['client_secret']
            );

            $accessToken->setRequest($pimple['request']);

            $accessToken->setRedirectUri($pimple['config']->get('redirect_uri'));

            return $accessToken;
        };

        $pimple['pre_auth'] = function ($pimple) {
            return new PreAuth($pimple);
        };

        $pimple['oauth'] = function ($pimple) {
            return new Oauth($pimple);
        };
    }
}