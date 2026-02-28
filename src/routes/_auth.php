<?php

/**
 * 認証画面のルート設定
 */

use App\Controllers\Auth\SessionController;

$router->get('/login', [SessionController::class, 'login'], ['name' => 'login']);
$router->post('/login', [SessionController::class, 'post']);
$router->post('/logout', [SessionController::class, 'logout'], ['name' => 'logout']);
