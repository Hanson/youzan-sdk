<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2017/2/22
 * Time: 22:30
 */

namespace Hanson\Youzan\Foundation;


use Doctrine\Common\Cache\FilesystemCache;
use Hanson\Youzan\Core\AccessToken;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Cache\Cache as CacheInterface;

/**
 * Class Application
 *
 * @property \Hanson\Youzan\Core\AccessToken $access_token
 * @property \Hanson\Youzan\Product\Product $product
 * @property \Hanson\Youzan\Trade\Trade $trade
 * @property \Hanson\Youzan\Tag\Tag $tag
 *
 */
class Application extends Container
{
    /**
     * Service Providers.
     *
     * @var array
     */
    protected $providers = [
        ServiceProviders\ProductServiceProvider::class,
        ServiceProviders\TradeServiceProvider::class,
        ServiceProviders\TagServiceProvider::class,
    ];

    public function __construct($config)
    {
        parent::__construct();

        $this['config'] = function () use ($config) {
            return new Config($config);
        };

        $this->registerProviders();
        $this->registerBase();
    }

    /**
     * Register providers.
     */
    private function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * Register basic providers.
     */
    private function registerBase()
    {
        $this['request'] = function () {
            return Request::createFromGlobals();
        };
        if (!empty($this['config']['cache']) && $this['config']['cache'] instanceof CacheInterface) {
            $this['cache'] = $this['config']['cache'];
        } else {
            $this['cache'] = function () {
                return new FilesystemCache(sys_get_temp_dir());
            };
        }
        $this['access_token'] = function () {
            return new AccessToken(
                $this['config']['app_id'],
                $this['config']['secret'],
                $this['cache']
            );
        };
    }

    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }
    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }

}