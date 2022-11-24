# Youzan SDK

有赞 SDK (支持有赞所有版本)

base on [foundation-sdk](https://github.com/HanSon/foundation-sdk)

## Requirement

- PHP >= 7
- **[composer](https://getcomposer.org/)**

## Installation

```
// 目前仅支持 hanson/foundation-sdk 3.x
composer require hanson/foundation-sdk:^3.1 -vvv
// 有赞云最新版支持
composer require hanson/youzan-sdk -vvv
```

## Usage

### 自用型应用

```php
<?php

$youzan = new \Hanson\Youzan\Youzan([
    'client_id' => '',
    'client_secret' => '',
    'debug' => true, // 调试模式
    'kdt_id' => '', // 店铺ID(仅自用模式下填写)
    'exception_as_array' => true, // 错误返回数组还是异常
    'version' => '4.0.0',
    'log' => [
        'name' => 'youzan',
        'file' => __DIR__.'/youzan.log',
        'level'      => 'debug',
        'permission' => 0777,
    ]
]);

// 获取订单
$result = $youzan->request('youzan.trade.get', ['tid' => 'xxx']);

// 获取门店信息（你可以设置调用api的版本）
$result = $youzan->setVersion('3.0.0')->request('youzan.shop.get');
```

### 工具型应用

```php
<?php

$youzan = new \Hanson\Youzan\Youzan([
    'client_id' => '',
    'client_secret' => '',
    'dev_client_id' => '工具型有容器的开发环境 client id', // 仅在 is_dev=true 时有用
    'dev_client_secret' => '工具型有容器的开发环境 client secret', // 仅在 is_dev=true 时有用
    'is_dev' => true, // 默认 false
    'debug' => true,
    'redirect_uri' => 'http://xxx.com',
    'exception_as_array' => true,
    'version' => '4.0.0',
    'log' => [
        'name' => 'youzan',
        'file' => __DIR__.'/youzan.log',
        'level'      => 'debug',
        'permission' => 0777,
    ]
]);

// 解密消息
$youzan->decrypt->decrypt($message);

/**
* 切换开发模式
 *
 * 新版有赞云工具型有容器应用中，同一应用测试环境与正式环境的 client_id 和 client_secret都不一样，故此添加了 dev_client_id，dev_client_secret 和此方法，用于切换不同环境下的开发，默认为false，正式开发可以不调用此方法
 */
$youzan->setDev(true);

// 使用配置中的 prod_client_secret 进行解密
$youzan->decrypt->decryptWithProd($message);

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

// 店铺信息
$result = $youzan->request('youzan.shop.get');

// 上传图片（4.0以上版本）
$result = $youzan->request('youzan.materials.storage.platform.img.upload', [], ['image' => [file_get_contents('https://i.loli.net/2018/12/17/5c17334487566.jpg')]]);
```

### 消息推送

```php
<?php
// 消息结构体
$data = $youzan->push->parse();

// 开发者自行选择性处理,把 "null" 与 "" 转为 null，建议使用
// $data = Helper::toNull($data);

$response = $youzan->push->response();

// $response 为 `Symfony\Component\HttpFoundation\Response` 实例
// 对于需要直接输出响应的框架，或者原生 PHP 环境下
$response->send();

// 而 Laravel 中直接返回即可：
return $response;
```

## 升级指南

### 4.* -> 5.*

```
* 4.* 的时候会对 api response 做处理，只返回 $response['response'] 部分
* 5.* 以后默认原样返回 youzan api 的 response，不再二次处理，请注意更新业务代码
```

### 3.* -> 4.*

```
* 构造函数设置了 `$config['exception_as_array'] = true;` 错误会返回包含 `error_response` 键名的数组（以前没有）
* 上传图片为 `$youzan->request('youzan.materials.storage.platform.img.upload', [], ['image' => [$bytes]]);`
```

## Help

QQ 群： 570769430

## License

MIT
