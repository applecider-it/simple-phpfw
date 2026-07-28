<?php

namespace App\Controllers;

use SFW\Output\Log;
use SFW\Data\Arr;
use SFW\Web\Response;

use App\Validations\Validator;

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
        $form = Arr::choise($this->params, ['message']);

        $rules = [
            'message' => ['required'],
        ];

        $labels = [
            'message' => 'メッセージ',
        ];

        $v = Validator::make($form, $rules, $labels);

        if ($v->fails()) {
            // エラーがあるとき

            $errors = $v->errors();

            Response::code(422);
            return compact('errors');
        }

        $webSocketService = new WebSocketService;

        $webSocketService->broadcast($form['message']);

        return ['status' => true];
    }
}
