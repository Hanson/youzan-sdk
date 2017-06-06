<?php

namespace Hanson\Youzan\Shop;

use Hanson\Youzan\Core\AbstractAPI;
use Illuminate\Support\Collection;

class Shop extends AbstractAPI
{
    const API_GET = "https://open.youzan.com/api/entry/youzan.shop/3.0.0/get";
    const API_ADDRESS_CREATE = "https://open.youzan.com/api/entry/youzan.shop.address/3.0.0/create";
    const API_ADDRESS_GET = "https://open.youzan.com/api/entry/youzan.shop.address/3.0.0/get";
    const API_ADDRESS_UPDATE = "https://open.youzan.com/api/entry/youzan.shop.address/3.0.0/update";
    const API_ADDRESS_LIST = "https://open.youzan.com/api/entry/youzan.shop.address/3.0.0/list";
    const API_ADDRESS_DELETE = "https://open.youzan.com/api/entry/youzan.shop.address/3.0.0/delete";

    /**
     * get shop base info
     *
     * @param array $params
     * @return Collection
     */
    public function get($params = [])
    {
        $result = $this->parseJSON('post', 'youzan.shop.get', [self::API_GET, $params]);
        return new Collection($result['response']);
    }

    /**
     * create a shop address
     *
     * @param array $params
     * @return Collection
     */
    public function createAddress($params = [])
    {
        $result = $this->parseJSON('post', 'youzan.shop.address.create', [self::API_ADDRESS_CREATE, $params]);
        return new Collection($result['response']);
    }

    /**
     * get a shop address list of all by shop id
     *
     * @param int $id
     * @return Collection
     */
    public function getAddress($id = 1)
    {
        $result = $this->parseJSON('post', 'youzan.shop.address.get', [self::API_ADDRESS_GET, ['id' => $id]]);
        return new Collection($result['response']);
    }

    /**
     * update shop address
     *
     * @param array $params
     * @return Collection
     */
    public function updateAddress($params = [])
    {
        $result = $this->parseJSON('post', 'youzan.shop.address.get', [self::API_ADDRESS_UPDATE, $params]);
        return new Collection($result['response']);
    }

    /**
     * get shop address list of all
     *
     * @param string $type
     * @return Collection
     */
    public function getAddressList($type = 'return')
    {
        $result = $this->parseJSON('post', 'youzan.shop.address.list', [self::API_ADDRESS_LIST, ['type' => $type]]);
        return new Collection($result['response']);
    }

    /**
     * delete a shop address by address id
     *
     * @param int $id
     * @return Collection
     */
    public function deleteAddress($id = 1)
    {
        $result = $this->parseJSON('post', 'youzan.shop.address.delete', [self::API_ADDRESS_DELETE, ['id' => $id]]);
        return new Collection($result['response']);
    }
}
