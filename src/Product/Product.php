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

    const API_GET = 'https://open.youzan.com/api/entry/kdt.items.custom/1.0.0/get';
    const API_ADD = 'https://open.youzan.com/api/entry/kdt.item/1.0.0/add';
    const API_UPDATE = 'https://open.youzan.com/api/entry/kdt.item/1.0.0/update';
    const API_LISTING = 'https://open.youzan.com/api/entry/kdt.item.update/1.0.0/listing';
    const API_DELISTING = 'https://open.youzan.com/api/entry/kdt.item.update/1.0.0/delisting';

    /**
     * Product constructor.
     * @param AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        parent::__construct($accessToken);
    }

    /**
     * get a detail about a product
     *
     * @param $params
     * @return mixed
     */
    public function get($params)
    {
        $product = $this->parseJSON('post', 'kdt.items.custom.get', [self::API_GET, $params]);

        return $product['response']['items'];
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

        return $product['response']['item'];
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

        return $product['response']['item'];
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

        return $product['response']['item'];
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

        return $product['response']['item'];
    }

}