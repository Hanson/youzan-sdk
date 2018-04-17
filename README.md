# Youzan SDK

有赞SDK (有赞 3.0.0)

base on [foundation-sdk](https://github.com/HanSon/foundation-sdk)

## Requirement

- PHP >= 5.5
- **[composer](https://getcomposer.org/)**

## Installation

```
composer require hanson/youzan-sdk
```

## Usage

### 自用型应用

```php
<?php

$youzan = new \Hanson\Youzan\Youzan([
    'client_id' => '',
    'client_secret' => '',
    'type' => \Hanson\Youzan\Youzan::PERSONAL, // 自用型应用
    'debug' => true, // 调试模式
    'kdt_id' => '19144834', // 店铺ID
    'log' => [
        'name' => 'youzan',
        'file' => __DIR__.'/youzan.log',
        'level'      => 'debug',
        'permission' => 0777,
    ]
]);

// 获取门店信息
$result = $youzan->request('youzan.shop.get');
```

### 工具型应用

```php
<?php

$youzan = new \Hanson\Youzan\Youzan([
    'client_id' => '',
    'client_secret' => '',
    'debug' => true,
    'redirect_uri' => 'http://xxx.com',
    'log' => [
        'name' => 'youzan',
        'file' => __DIR__.'/youzan.log',
        'level'      => 'debug',
        'permission' => 0777,
    ]
]);

// 获取授权 URL
$url = $youzan->pre_auth->authorizationUrl();

// 重定向到授权页面
$youzan->pre_auth->authorizationRedirect();

// 在重定向页面，你可以获取此次授权账号的 token
$token = $youzan->pre_auth->getAccessToken();

// 也可以通过上面得到的 refresh_token 去刷新令牌
$token = $youzan->pre_auth->refreshToken($token['refresh_token']);

// 创建授权应用
$youzan = $youzan->oauth->createAuthorization($token['token']);

$result = $youzan->request('youzan.shop.get');
```

### 平台型应用

```php
<?php

$youzan = new \Hanson\Youzan\Youzan([
    'client_id' => '',
    'client_secret' => '',
    'type' => \Hanson\Youzan\Youzan::PLATFORM,
    'debug' => true,
//    'kdt_id' => '19144834', // 可选,用于控制某个门店
    'log' => [
        'name' => 'youzan',
        'file' => __DIR__.'/youzan.log',
        'level'      => 'debug',
        'permission' => 0777,
    ]
]);

// 平台创建门店
$result = $youzan->request('youzan.shop.create', [
    'name' => 'HanSon的教学课堂',
]);

// 平台已授权门店
$youzan = $youzan->setKdtId('19144834');
$result = $youzan->request('youzan.shop.get');

// 获取订单
$result = $youzan->request('youzan.trade.get', ['tid' => 'xxxxx']);
```

## Help

QQ 群： 570769430

## License

MIT
