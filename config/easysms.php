<?php
return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'qcloud',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'qcloud' => [
            'sdk_app_id' => '1400139946', // SDK APP ID
            'app_key' => 'dac5f56473df07df6762d35fc6ce0c0f', // APP KEY
            'sign_name' => 'this is givename', // 短信签名，如果使用默认签名，该字段可缺省（对应官方文档中的sign）
        ],
    ],
];




//$sms = app('easysms');
//try {
//    $sms->send(13380030145, [
//        'content'  => '【asdasd',
//    ]);
//} catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
//    $message = $exception->getException('qcloud')->getMessage();
//    dd($message);
//}