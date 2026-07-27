<?php

namespace App\Services\WebSocket;

use SFW\Core\Config;
use SFW\Output\Log;

/**
 * Pusher管理
 */
class Pusher
{
    private string $host;
    private string $appId;
    private string $key;
    private string $secret;
    private int $port = 80;
    private bool $useTLS = false;

    function __construct()
    {
        $this->host = Config::get('app.pusher.host');
        $this->appId = Config::get('app.pusher.appId');
        $this->key = Config::get('app.pusher.appKey');
        $this->secret = Config::get('app.pusher.appSecret');
        $this->port = Config::get('app.pusher.port');
        $this->useTLS = Config::get('app.pusher.useTls');
    }

    /** ブロードキャスト */
    public function broadcast(string $channel, string $event, mixed $data)
    {
        Log::info('Pusher::send', [$channel, $event, $data]);

        $body = $this->createBody($channel, $event, $data);

        $queryString = $this->createQueryString($body);

        $url = $this->createUrl($queryString);

        $result = $this->send($url, $body);

        Log::info('Pusher::send result', [$result]);
    }

    /**
     * イベントデータ作成
     * 
     * dataフィールドはJSON文字列化する必要あり
     */
    private function createBody(string $channel, string $event, mixed $data)
    {
        $payloadData = is_string($data) ? $data : json_encode($data, JSON_UNESCAPED_UNICODE);

        // 送信ペイロードの作成
        $bodyArray = [
            'name'     => $event,
            'channels' => [$channel],
            'data'     => $payloadData,
        ];

        return json_encode($bodyArray, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 署名用クエリパラメータの準備
     * 
     * キー名で昇順ソート
     */
    private function createQueryString(string $body)
    {
        $bodyMd5 = md5($body);
        $timestamp = time();

        $params = [
            'auth_key'       => $this->key,
            'auth_timestamp' => $timestamp,
            'auth_version'   => '1.0',
            'body_md5'       => $bodyMd5,
        ];

        ksort($params);

        return http_build_query($params);
    }

    /** URL作成 */
    private function createUrl(string $queryString)
    {
        $scheme = $this->useTLS ? 'https' : 'http';
        $path = "/apps/{$this->appId}/events";

        // 署名対象文字列の組み立て (METHOD\nPATH\nQUERY_STRING)
        $stringToSign = "POST\n{$path}\n{$queryString}";

        // HMAC-SHA256 で署名を生成
        $signature = hash_hmac('sha256', $stringToSign, $this->secret);

        // 最終リクエストURL
        return "{$scheme}://{$this->host}:{$this->port}{$path}?{$queryString}&auth_signature={$signature}";
    }

    /** REST送信 */
    private function send(string $url, string $body)
    {
        // cURL リクエスト送信
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($body),
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);

        return [
            'success'  => ($httpCode === 200),
            'code'     => $httpCode,
            'response' => $response,
            'error'    => $curlError,
        ];
    }
}
