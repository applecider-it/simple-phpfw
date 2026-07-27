<?php

namespace App\Services\Chat;

use App\Services\User\AuthService as Auth;
use App\Services\WebSocket\Pusher;

/**
 * WebSocket管理
 */
class WebSocketService
{
    private string $channelId = 'simplephpfw-chat-channel';

    /** ブロードキャスト */
    public function broadcast(string $message)
    {
        $pusher = new Pusher();

        $user = Auth::get();

        $pusher->broadcast(
            $this->channelId,
            'new-message',
            [
                'message' => $message,
                'user_id' => $user['id'],
                'name' => $user['name'],
            ]
        );
    }
}
