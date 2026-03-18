<?php

namespace App\Services\Commands;

use SFW\Core\App;

use App\Services\Chat\WebSocketService;

/**
 *  WebSocketの動作確認コマンド用サービス
 */
class WebSocketTestCommandService
{
    public function exec(array $params, array $options)
    {
        echo "Begin WebSocketTestCommandService\n";

        $msg = 'From System (R) ' . date('Y/m/d H:i:s');

        // 送信上限（これ以外1バイトでも多いと失敗する）
        $msg = 'From System (R) aaaaaaaaaaaaaaaa' . date('Y/m/d H:i:s');

        $user = [
            "name" => "Redis"
        ];
        $webSocketService = new WebSocketService;
        $webSocketService->bloadcast('default', $msg, $user);
    }
}
