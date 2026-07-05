<?php

namespace App\Controllers;

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Data\Arr;
use SFW\Core\Lang;
use SFW\Output\Log;
use SFW\Web\Response;

use function SFW\Helpers\route;

use App\Models\User;
use App\Models\User\Tweet;

use App\Validations\Validator;

use App\Services\User\AuthService as Auth;
use App\Services\Tweet\ListService;

/**
 * ツイート(JS)コントローラー
 */
class TweetJsController extends Controller
{
    /** ツイート画面 */
    public function index()
    {
        return $this->render('tweet-js.index');
    }

    /** 一覧API */
    public function list()
    {
        $listService = new ListService;

        return $listService->getTweets();
    }

    /** 登録処理API */
    public function store()
    {
        $form = Arr::choise($this->params, ['content']);

        $rules = [
            'content' => Tweet::validationContent(),
        ];

        $labels = [
            'content' => Lang::get('app.models.user/tweet.attributes.content'),
        ];

        $v = Validator::make($form, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            // エラーがあるとき

            $errors = $v->errors();

            Response::code(422);
            return compact('errors');
        }

        $user = Auth::get();
        $newId = Tweet::insert(['user_id' => $user['id']] + $form);
        Log::info('New Tweet', [$newId]);

        return compact('newId');
    }
}
