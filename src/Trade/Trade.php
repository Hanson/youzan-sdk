<?php

namespace Hanson\Youzan\Trade;


use Hanson\Youzan\Core\AbstractAPI;
use Illuminate\Support\Collection;

class Trade extends AbstractAPI
{

    const API_UPDATE_MEMO = 'https://open.youzan.com/api/entry/kdt.trade.memo/1.0.0/update';
    const API_SELF_APPLY = 'https://open.youzan.com/api/entry/kdt.trade.selffetchcode/1.0.0/apply';
    const API_GET = 'https://open.youzan.com/api/entry/kdt.trades.sold/2.0.0/get';
    const API_FIND = 'https://open.youzan.com/api/entry/kdt.trade/2.0.0/get';
    const API_SIGN_CLOSE = 'https://open.youzan.com/api/entry/kdt.trade.sign/1.0.0/close';
    const API_SIGN_ITEM_CLOSE = 'https://open.youzan.com/api/entry/kdt.trade.sign.item/1.0.0/close';
    const API_SELF_GET = 'https://open.youzan.com/api/entry/kdt.trade.selffetchcode/1.0.0/get';
    const API_GET_BY_USER = 'https://open.youzan.com/api/entry/kdt.trades.sold/1.0.0/getforouter';
    const API_CLOSE = 'https://open.youzan.com/api/entry/kdt.trade/1.0.0/close';

    /**
     * update a memo for a trade
     *
     * @param $params
     * @return Collection
     */
    public function updateMemo($params)
    {
        $result = $this->parseJSON('post', 'kdt.trade.memo.update', [self::API_UPDATE_MEMO, $params]);

        return new Collection($result['response']['trade']);
    }

    /**
     * to fetch a trade by code
     *
     * @param $code
     * @return bool
     */
    public function selfApply($code)
    {
        $result = $this->parseJSON('post', 'kdt.trade.selffetchcode.apply', [self::API_SELF_APPLY, ['code' => $code]]);

        return $result['response']['is_success'];
    }

    /**
     * find a trade
     *
     * @param $params
     * @return Collection
     */
    public function find($params)
    {
        $result = $this->setVersion('2.0.0')->parseJSON('post', 'kdt.trade.get', [self::API_FIND, $params]);

        return new Collection($result['response']['trade']);
    }

    /**
     * sign a trade as refund
     * 
     * @param $params
     * @return bool
     */
    public function signRefund($params)
    {
        $result = $this->parseJSON('post', 'kdt.trade.sign.item.close', [self::API_SIGN_ITEM_CLOSE, $params]);

        return $result['response'];
    }

    /**
     * sing a trade as close
     *
     * @param $tid
     * @return bool
     */
    public function signClose($tid)
    {
        $result = $this->parseJSON('post', 'kdt.trade.sign.close', [self::API_SIGN_CLOSE, ['tid' => $tid]]);

        return $result['response'];
    }

    /**
     * get trades
     *
     * @param $params
     * @return Collection
     */
    public function get($params = [])
    {
        $result = $this->setVersion('2.0.0')->parseJSON('post', 'kdt.trades.sold.get', [self::API_GET, $params]);

        return new Collection($result['response']);
    }

    /**
     * get a trade with code
     *
     * @param $params
     * @return Collection
     */
    public function selfGet($params)
    {
        $result = $this->parseJSON('post', 'kdt.trade.selffetchcode.get', [self::API_SELF_GET, $params]);

        return new Collection($result['response']);
    }

    /**
     * get trades by user
     *
     * @param $params
     * @return Collection
     */
    public function getByUser($params)
    {
        $result = $this->parseJSON('post', 'kdt.trades.sold.getforouter', [self::API_GET_BY_USER, $params]);

        return new Collection($result['response']);
    }

    /**
     * close a trade
     *
     * @param $params
     * @return Collection
     */
    public function close($params)
    {
        $result = $this->parseJSON('post', 'kdt.trade.close', [self::API_CLOSE, $params]);

        return new Collection($result['response']['trade']);
    }

}