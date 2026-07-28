<?php

namespace App\Controllers;

use SFW\Output\Log;
use SFW\Data\Arr;
use SFW\Web\Response;

use App\Validations\Validator;

use App\Services\Chat\WebSocketService;
use App\Services\Chat\RoomService;

/**
 * チャットコントローラー
 */
class ChatController extends Controller
{
    /** チャット画面 */
    public function index()
    {
        $roomService = new RoomService;

        $room = $this->params['room'] ?? null;

        $ret = $roomService->getRoomInfo($room);

        $room = $ret['room'];
        $rooms = $ret['rooms'];

        return $this->render('chat.index', compact('room', 'rooms'));
    }

    /** 登録API */
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

        $webSocketService->broadcast($form['message'], $this->params['room']);

        return ['status' => true];
    }
}
