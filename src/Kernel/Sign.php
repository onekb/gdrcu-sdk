<?php

namespace Onekb\Gdrcu\Kernel;

use Onekb\Gdrcu\Kernel\Config;

class Sign
{

    protected $app;

    protected Config $config;

    public function __construct($app)
    {
        $this->app = $app;

        $this->config = $this->app->config;
    }

    public function encode($tranCode, $body)
    {
        $data = [
            'tranCode' => $tranCode,
            'version' => '1.0.0',
            'cstId' => $this->config->get('mercId'),
            'body' => $body,
        ];



        $string  = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $priKey =  openssl_pkey_get_private($this->config->get('priRsaKey'));


        $signature = '';
        openssl_sign($string, $signature, $priKey, 'MD5');

        return base64_encode(base64_encode($signature));
    }

    public function check($oriStr, $tranCode): bool
    {
        $data = json_decode($oriStr, true);

        $start = strpos($oriStr, '"body":') + strlen('"body":');
        $end = strpos($oriStr, '}', $start);
        $body = substr($oriStr, $start, $end - $start + 1);

        $string = json_encode([
            'tranCode' => $tranCode,
            'version' => '1.0.0',
            'cstId' => $this->config->get('mercId'),
            'body' => $body,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);


        $oriStr = str_replace('\\"', '"', $oriStr);
        $posA = strpos($oriStr, '"body":"');
        $posB = strpos($oriStr, '"}', $posA);
        $oriStr = substr_replace($oriStr, '', $posA + strlen('"body":"') - 1, 1);
        $string = substr_replace($oriStr, '', $posB + 1, 1);

        $signature = base64_decode(base64_decode($data['service']['head']['signature']));

        $pubKey = openssl_pkey_get_public($this->config->get('xthPubRsaKey'));

        return (bool)openssl_verify($string, $signature, $pubKey, "MD5");
    }
}
