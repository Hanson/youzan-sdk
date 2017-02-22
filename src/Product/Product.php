<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2017/2/22
 * Time: 22:38
 */

namespace Hanson\Youzan\Product;


use Hanson\Youzan\Core\AbstractAPI;
use Hanson\Youzan\Core\AccessToken;

class Product extends AbstractAPI
{

    public function __construct(AccessToken $accessToken)
    {
        parent::__construct($accessToken);
    }

}