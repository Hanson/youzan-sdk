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

基本使用（以添加产品为例）:

```php
<?php

use Hanson\Youzan\Foundation\Application;

$app = new Application([
    'app_id' => 'your app_id',
    'secret' => 'your app_secret'
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
已实现
- [x] 产品

- [x] 订单

- [x] 商品类目

如有其它API需求可提issue或者参考下方的 `Contribution` 一起共同完善。

## Contribution

- [Contribution Guide](https://github.com/HanSon/youzan-sdk/wiki/%E5%8F%82%E4%B8%8E%E8%B4%A1%E7%8C%AE)

## License

MIT
