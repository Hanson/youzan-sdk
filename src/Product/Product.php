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

    const API_ADD = 'https://open.youzan.com/api/entry/kdt.item/1.0.0/add';

    public function __construct(AccessToken $accessToken)
    {
        parent::__construct($accessToken);
    }

    public function add($params, $files = [])
    {
        return $this->parseJSON('kdt.item.add', self::API_ADD, $params, 'upload');
    }

}