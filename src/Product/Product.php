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
use Illuminate\Support\Collection;

class Product extends AbstractAPI
{

    const API_GET = 'https://open.youzan.com/api/entry/kdt.items.custom/1.0.0/get';
    const API_FIND = 'https://open.youzan.com/api/entry/kdt.item/1.0.0/get';
    const API_GET_SKU = 'https://open.youzan.com/api/entry/kdt.skus.custom/1.0.0/get';
    const API_ADD = 'https://open.youzan.com/api/entry/kdt.item/1.0.0/add';
    const API_UPDATE = 'https://open.youzan.com/api/entry/kdt.item/1.0.0/update';
    const API_UPDATE_SKU = 'https://open.youzan.com/api/entry/kdt.item.sku/1.0.0/update';
    const API_DELETE = 'https://open.youzan.com/api/entry/kdt.item/1.0.0/delete';
    const API_LISTING = 'https://open.youzan.com/api/entry/kdt.item.update/1.0.0/listing';
    const API_DELISTING = 'https://open.youzan.com/api/entry/kdt.item.update/1.0.0/delisting';
    const API_INVENTORY = 'https://open.youzan.com/api/entry/kdt.items.inventory/1.0.0/get';
    const API_ON_SALE = 'https://open.youzan.com/api/entry/kdt.items.onsale/1.0.0/get';
    const API_BATCH_LISTING = 'https://open.youzan.com/api/entry/kdt.items.update/1.0.0/listing';
    const API_BATCH_DELISTING = 'https://open.youzan.com/api/entry/kdt.items.update/1.0.0/delisting';

    /**
     * Product constructor.
     * @param AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        parent::__construct($accessToken);
    }

    /**
     * find a product
     *
     * @param $params
     * @return Collection
     */
    public function find($params)
    {
        $product = $this->parseJSON('post', 'kdt.item.get', [self::API_FIND, $params]);

        return new Collection($product['response']['item']);
    }

    /**
     * get a detail about products
     *
     * @param $params
     * @return mixed
     */
    public function get($params)
    {
        $product = $this->parseJSON('post', 'kdt.items.custom.get', [self::API_GET, $params]);

        return new Collection($product['response']['items']);
    }

    /**
     * get skus of a product
     *
     * @param $params
     * @return Collection
     */
    public function getSku($params)
    {
        $product = $this->parseJSON('post', 'kdt.skus.custom.get', [self::API_GET_SKU, $params]);

        return new Collection($product['response']['skus']);
    }

    /**
     * add a product
     *
     * @param $params
     * @param array $files
     * @return mixed
     */
    public function add($params, $files = [])
    {
        $product = $this->parseJSON('upload', 'kdt.item.add', [self::API_ADD, $params, $files]);

        return new Collection($product['response']['item']);
    }

    /**
     * update a product
     *
     * @param $params
     * @param array $files
     * @return mixed
     */
    public function update($params, $files = [])
    {
        $product = $this->parseJSON('upload', 'kdt.item.update', [self::API_UPDATE, $params, $files]);

        return new Collection($product['response']['item']);
    }

    /**
     * update a sku of product
     *
     * @param $params
     * @return Collection
     */
    public function updateSku($params)
    {
        $product = $this->parseJSON('post', 'kdt.item.sku.update', [self::API_UPDATE_SKU, $params]);

        return new Collection($product['response']['sku']);
    }

    /**
     * delete a product
     *
     * @param $numIid
     * @return mixed
     */
    public function delete($numIid)
    {
        $product = $this->parseJSON('post', 'kdt.item.delete', [self::API_DELETE, ['num_iid' => $numIid]]);

        return $product['response']['is_success'];
    }

    /**
     * put a product on shelve
     *
     * @param $params
     * @return mixed
     */
    public function listing($params)
    {
        $product = $this->parseJSON('post', 'kdt.item.update.listing', [self::API_LISTING, $params]);

        return new Collection($product['response']['item']);
    }

    /**
     * put a product off shelve
     *
     * @param $params
     * @return mixed
     */
    public function delisting($params)
    {
        $product = $this->parseJSON('post', 'kdt.item.update.delisting', [self::API_DELISTING, $params]);

        return new Collection($product['response']['item']);
    }

    /**
     * get a list of warehouse products
     *
     * @param $params
     * @return mixed
     */
    public function getDelisting($params)
    {
        $product = $this->parseJSON('post', 'kdt.items.inventory.get', [self::API_INVENTORY, $params]);

        return new Collection($product['response']['items']);
    }

    /**
     * get a list of on sale products
     *
     * @param $params
     * @return mixed
     */
    public function getListing($params)
    {
        $product = $this->parseJSON('post', 'kdt.items.onsale.get', [self::API_ON_SALE, $params]);

        return new Collection($product['response']['items']);
    }

    /**
     * put a list of product on sale
     *
     * @param $num_iids
     * @return mixed
     */
    public function batchListing($num_iids)
    {
        $params = is_array($num_iids) ? $num_iids : ['num_iids' => $num_iids];
        $product = $this->parseJSON('post', 'kdt.items.update.listing', [self::API_BATCH_LISTING, $params]);

        return $product['response']['is_success'];
    }

    /**
     * put a list of product off sale
     *
     * @param $num_iids
     * @return mixed
     */
    public function batchDelisting($num_iids)
    {
        $params = is_array($num_iids) ? $num_iids : ['num_iids' => $num_iids];
        $product = $this->parseJSON('post', 'kdt.items.update.delisting', [self::API_BATCH_DELISTING, $params]);

        return $product['response']['is_success'];
    }

}