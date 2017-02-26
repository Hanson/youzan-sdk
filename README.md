# Youzan SDK

最优雅的有赞SDK

## Requirement

- PHP >= 5.5
- **[composer](https://getcomposer.org/)**

## Installation

```
composer require hanson/youzan-sdk
```

## Usage

基本使用（以服务端为例）:

```php
<?php

use Hanson\Youzan\Foundation\Application;

$app = new Application([
    'app_id' => '124286ccc1da10f3de',
    'secret' => 'd8715349e02f84ec3e1e9005ffc2485f'
]);

$result = $app->product->add([
    'title' => '产品名称',
    'price' => '899.99',
    'post_fee' => '0',
    ],[
        'images' => [
            __DIR__ . '/img/head.jpg',
            __DIR__ . '/img/gcu.jpg',
        ]
    ]
);

print_r($result);

```

## Documention

- [wiki](https://github.com/HanSon/youzan-sdk/wiki)

## Support

此 SDK 只实现了最基础的（产品、订单和商品分类），如有其它API需求可提issue或者参考下方的 `Contribution` 一起完善。

## Contribution

- [Contribution Guide](https://github.com/HanSon/youzan-sdk/wiki/contribution)

## License

MIT