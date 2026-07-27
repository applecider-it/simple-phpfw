<?php

namespace App\Controllers;

use SFW\Output\Log;

use App\Services\Chat\WebSocketService;

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
        $webSocketService = new WebSocketService;

        $webSocketService->broadcast($this->params['message']);
    }
}
