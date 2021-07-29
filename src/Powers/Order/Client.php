<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Onekb\Gdrcu\Powers\Order;

use Onekb\Gdrcu\Powers\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 二维码下单.
     *
     * @return void
     */
    public function getQrCode(array $params)
    {
        $date = date('Ymd');
        $time = date('His');

        $config = $this->app->config;

        $head = [
            'tranCode' => 'getQrCode', // 交易码
            'version' => '1.0.0', // 版本号
            'cstId' => $config->get('mercId'), // 客户端系统编号
            // 'cstSeqNo' => '', // 客户端系统流水号
            'cstTxnDt' => $date, // 客户端系统交易日期
            'cstTxnTm' => $time, // 客户端系统交易时间
            // 'origCstSeqNo' => '', // 源客户端系统流水号
            'origCstTxnDt' => $date, // 源客户端系统交易日期
            'origCstTxnTm' => $time, // 源客户端系统交易时间
            // 'signatureFlag' => 'true', // 是否数字签名（貌似非必填）
        ];
        $head = array_default_merge($head, $params);

        $body = [
            'outTradeNo' => '', // 外部商户订单号
            'mercId' => $config->get('mercId'), // 商户ID
            'qrType' => '01', // 二维码类型 01商户码 02店铺码 03店员码
            'payOrderAmount' => 0.01, // 订单金额 单位元 带两小数点
            'qrSource' => '1', // 二维码来源 2银联码
            'createType' => '2', // 二维码生成方式 2动态生成
            'remark' => '', // 备注
            // 'validTime' => '3', //二维码有效期 默认三分钟 单位分钟
        ];

        $body = array_default_merge($body, $params);

        $body = [
            'service' => [
                'version' => '2.0',
                'head' => $head,
                'body' => $body,
            ],
        ];

        return $this->app->http->post('/merchantFront/getQrCode', $body);
    }

    /**
     * 订单查询.
     *
     * @return void
     */
    public function inspOrder(array $params)
    {
        $date = date('Ymd');
        $time = date('His');

        $config = $this->app->config;

        $head = [
            'tranCode' => 'inspOrder', //交易码
            'version' => '1.0.0', //版本号
            'cstId' => $config->get('mercId'), //客户端系统编号
            'cstTxnDt' => $date, //客户端系统交易日期
            'cstTxnTm' => $time, //客户端系统交易时间
            'origCstTxnDt' => $date, //源客户端系统交易日期
            'origCstTxnTm' => $time, //源客户端系统交易时间
        ];
        $head = array_default_merge($head, $params);

        $body = [
            'payOrdNo' => '',
            'outTradeNo' => '',
        ];

        $body = array_default_merge($body, $params);

        $body = [
            'service' => [
                'version' => '2.0',
                'head' => $head,
                'body' => $body,
            ],
        ];

        return $this->app->http->post('/merchantFront/inspOrder', $body);
    }

    /**
     * 申请退款.
     *
     * @return void
     */
    public function refund(array $params)
    {
        $date = date('Ymd');
        $time = date('His');

        $config = $this->app->config;

        $head = [
            'tranCode' => 'refund', //交易码
            'version' => '1.0.0', //版本号
            'cstId' => $config->get('mercId'), //客户端系统编号
            'cstTxnDt' => $date, //客户端系统交易日期
            'cstTxnTm' => $time, //客户端系统交易时间
            'origCstTxnDt' => $date, //源客户端系统交易日期
            'origCstTxnTm' => $time, //源客户端系统交易时间
        ];

        $head = array_default_merge($head, $params);

        $body = [
            'outTradeNo' => '',
            'origPayOrdNo' => '',
            'mercId' => $config->get('mercId'),
            'refundAmt' => 0,
            'refundCause' => '',
        ];

        $body = array_default_merge($body, $params);

        $body = [
            'service' => [
                'version' => '2.0',
                'head' => $head,
                'body' => $body,
            ],
        ];

        return $this->app->http->post('/merchantFront/refund', $body);
    }

    /**
     * 退款查询.
     *
     * @return void
     */
    public function qryRefund(array $params)
    {
        $date = date('Ymd');
        $time = date('His');

        $config = $this->app->config;

        $head = [
            'tranCode' => 'qryRefund', //交易码
            'version' => '1.0.0', //版本号
            'cstId' => $config->get('mercId'), //客户端系统编号
            'cstTxnDt' => $date, //客户端系统交易日期
            'cstTxnTm' => $time, //客户端系统交易时间
            'origCstTxnDt' => $date, //源客户端系统交易日期
            'origCstTxnTm' => $time, //源客户端系统交易时间
        ];

        $head = array_default_merge($head, $params);

        $body = [
            'refundOrdNo' => '',
            'outRefundNo' => '',
            'mercId' => $config->get('mercId'),
        ];

        $body = array_default_merge($body, $params);

        $body = [
            'service' => [
                'version' => '2.0',
                'head' => $head,
                'body' => $body,
            ],
        ];

        return $this->app->http->post('/merchantFront/qryRefund', $body);
    }
}
