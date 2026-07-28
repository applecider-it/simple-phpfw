<?php

namespace App\Services\Chat;

use App\Services\User\AuthService as Auth;
use App\Services\WebSocket\Pusher;

/**
 * WebSocket管理
 */
class WebSocketService
{
    private string $channelBaseId = 'simplephpfw-chat-channel';

    /** ブロードキャスト */
    public function broadcast(string $message, string $room)
    {
        $pusher = new Pusher();

        $user = Auth::get();

        $channelId = $this->channelBaseId . '--' . $room;

        $pusher->broadcast(
            $channelId,
            'new-message',
            [
                'message' => $message,
                'user_id' => $user['id'],
                'name' => $user['name'],
            ]
        );
    }
}
