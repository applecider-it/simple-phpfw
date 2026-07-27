<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Output\Log;

use App\Services\User\AuthService as Auth;
use App\Services\WebSocket\Pusher;

/**
 * チャットコントローラー
 */
class ChatController extends Controller
{
    /** チャット画面 */
    public function index()
    {
        return $this->render('chat.index');
    }

    /** 一覧API */
    public function store()
    {
        $pusher = new Pusher();

        $user = Auth::get();
        $pusher->broadcast(
            'simplephpfw-chat-channel',
             'new-message',
            [
            'message' => $this->params['message'],
            'user_id' => $user['id'],
            'name' => $user['name'],
        ]);
    }
}
