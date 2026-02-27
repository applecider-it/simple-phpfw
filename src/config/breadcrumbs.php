<?php

use SFW\Core\Config;

use SFW\Web\Breadcrumbs;

// 管理画面ホーム
$breadcrumbs->set('admin.dashboard', function (Breadcrumbs $breadcrumbs) {
    $arr = [];
    $arr[] = ['ダッシュボード', Config::get('app.adminPrefix')];
    return $arr;
});

// ユーザー一覧
$breadcrumbs->set('admin.users.index', function (Breadcrumbs $breadcrumbs) {
    $arr = $breadcrumbs->get('admin.dashboard');
    $arr[] = ['ユーザー', Config::get('app.adminPrefix') . '/users'];
    return $arr;
});

// ユーザー新規作成
$breadcrumbs->set('admin.users.create', function (Breadcrumbs $breadcrumbs) {
    $arr = $breadcrumbs->get('admin.users.index');
    $arr[] = ['新規作成', Config::get('app.adminPrefix') . '/users/create'];
    return $arr;
});

// ユーザー編集
$breadcrumbs->set('admin.users.edit', function (Breadcrumbs $breadcrumbs, array $user) {
    $arr = $breadcrumbs->get('admin.users.index');
    $arr[] = [$user['name'], Config::get('app.adminPrefix') . '/users/' . $user['id'] . '/edit'];
    return $arr;
});