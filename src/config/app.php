<?php

/**
 * アプリケーション独自の設定
 * 
 * @var array $env
 */

return [
    // 管理画面のprefix
    'adminPrefix' => '/admin_secret',

    // トレースで隠すキーリスト
    'trace_mask_keys' => [
        'password',
        'password_confirm',
    ],

    'pusher' => [
        'appKey' => $env['PUSHER_APP_KEY'],
        'host' => $env['PUSHER_HOST'],
        'port' => $env['PUSHER_PORT'],
        'appId' => $env['PUSHER_APP_ID'],
        'appSecret' => $env['PUSHER_APP_SECRET'],
        'useTls' => $env['PUSHER_USE_TLS'],
    ],

    'redis' => [
        'host' => '127.0.0.1',
        'port' => 6379,
    ]
];
