<?php

namespace App\Services\User;

use function SFW\Helpers\route;

use App\Models\User;

use App\Services\Auth\BaseService;

/**
 * ユーザーの認証管理
 */
class AuthService extends BaseService
{
    protected static string $containerKey = 'user';
    protected static string $containerDesc = 'ログインユーザー';
    protected static string $routeOptionValue = 'user';
    protected static string $authSessionKey = '___auth___user';

    public function __construct()
    {
        $this->loginUrl = route('login');
        $this->afterLoginUrl = route('index');
        $this->afterLogoutUrl = route('index');
        $this->model = User::class;
    }
}
