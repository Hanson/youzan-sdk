<?php


namespace Hanson\Youzan\Shop;


use Hanson\Youzan\Api;

class Shop extends Api
{

    public function setShopId($shopId)
    {
        $this->accessToken->setShopId($shopId);

        return $this;
    }
}