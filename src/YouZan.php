<?php


namespace Hanson\Youzan;


use Hanson\Foundation\Foundation;

/**
 * Class Youzan
 * @package Hanson\Youzan
 *
 * @property \Hanson\Youzan\Platform\Platform   $platform
 * @property \Hanson\Youzan\Personal\Personal   $personal
 * @property \Hanson\Youzan\Shop\Shop   $shop
 */
class Youzan extends Foundation
{

    protected $providers = [
        Platform\ServiceProvider::class,
        Personal\ServiceProvider::class,
        Shop\ServiceProvider::class,
    ];
}