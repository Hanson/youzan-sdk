<?php


namespace Hanson\Youzan\Oauth;


use Hanson\Youzan\Youzan;
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

        $pimple['oauth.access_token'] = function (Youzan $pimple) {
            $accessToken =  new AccessToken(
                $pimple->getConfig()['client_id'],
                $pimple->getConfig()['client_secret']
            );

            $accessToken->setRequest($pimple['request']);

            $accessToken->setRedirectUri($pimple->getConfig()['redirect_uri'] ?? null);

            return $accessToken;
        };

        $pimple['pre_auth'] = function (Youzan $pimple) {
            return new PreAuth($pimple);
        };

        $pimple['oauth'] = function (Youzan $pimple) {
            return new Oauth($pimple);
        };

        $pimple['decrypt'] = function (Youzan $pimple) {
            return new Decrypt($pimple);
        };
    }
}