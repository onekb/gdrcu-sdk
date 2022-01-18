<h1 align="center"> gdrcu-sdk </h1>

<p align="center"> 广东农信统一支付平台SDK（非官方）</p>

## Installing

```shell
$ composer require onekb/gdrcu -vvv
```

## Usage

1. 初始化配置Gdrcu

```php
$app = \Onekb\Gdrcu\Factory::Gdrcu([
    'host' => 'https://pay.xxx.com', // 请联系你的客户经理获取正式平台地址
    'response_type' => 'array', // 返回格式
    'pubRsaKey' => $pubRsaKey, // 公钥 请联系你的客户经理获取
    'priRsaKey' => $priRsaKey, // 私钥 请联系你的客户经理获取
    'xthPubRsaKey' => $xthPubRsaKey, // 鲜特汇公钥 请联系你的客户经理获取
    'mercId' => $mercId, // 商户号 请联系你的客户经理获取
    'timeout' => 5, // Guzzle超时时间
    'connect_timeout' => 5, // Guzzle链接超时时间

]);
```

2. 使用功能

```php
// 二维码下单
$a = $app->order->getQrCode([
    'outTradeNo' => substr(md5(time()), 0, 10), // 单号
    'payOrderAmount' => 0.01, // 金额
    'remark' => '测试支付' //备注
]);

// 查询订单
$a = $app->order->inspOrder([
    // 'outTradeNo' => 'xxxxxx', // 外部商户接入平台的订单号 二选一
    'payOrdNo' => 'xxxx', // 平台支付订单号 二选一
]);

// 申请退款
$a = $app->order->refund([
    'outTradeNo' => 'AAAAAAA', // 外部商户接入平台的订单号
    'origPayOrdNo' => 'BBBBBBB', // 原外部商户接入平台的订单号
    'refundAmt' => 0.01, // 退款金额
    'refundCause' => '手工退款' // 退款原因
]);

// 查询退款
$a = $app->order->qryRefund([
    'outRefundNo' => 'AAAAAAA', // 接入商户流水号
    'refundOrdNo' => 'BBBBBBB', // 平台退款订单号
]);
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/onekb/gdrcu/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/onekb/gdrcu/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and
PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT