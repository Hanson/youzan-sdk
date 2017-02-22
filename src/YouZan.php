<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2017/2/22
 * Time: 22:06
 */

namespace Hanson\Youzan;


class YouZan
{

    protected $appId;

    protected $secret;

    public function __construct($appId, $secret)
    {
        if (!$appId || !$secret) throw new \Exception('appId 和 secret 不能为空');

        $this->appId = $appId;
        $this->secret = $secret;
    }
}