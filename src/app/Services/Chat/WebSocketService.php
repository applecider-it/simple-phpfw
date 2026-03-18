<?php

namespace App\Services\Chat;

use SFW\Core\App;

use App\Services\WebSocket\SystemService;
use App\Services\Channels\ChatChannel;

/**
 *  チャットのWebSocketサービス
 */
class WebSocketService
{
    /**
     * チャットをブロードキャスト
     */
    public function bloadcast(string $room, string $message, array $user)
    {
        $systemService = new SystemService;
        $systemService->publish(ChatChannel::getChannel($room), [
            'message' => $message,
            'name' => $user['name'],
        ]);
    }
}
