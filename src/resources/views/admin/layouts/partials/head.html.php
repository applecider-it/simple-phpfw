<?php

use App\Services\AdminUser\AuthService as Auth;
use SFW\Core\App;

$vite = App::get('vite');

$adminUser = Auth::get();
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?= $this->render('partials.form.csrf_meta') ?>

<title><?= $this->h($title ?? $this->config('applicationName')) ?></title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<?php if ($adminUser): ?>
    <meta name="admin-user" data-json="<?= $this->h(json_encode($adminUser)) ?>">
<?php endif; ?>

<?= $this->render('partials.app.meta') ?>

<?= $vite->init() ?>
<?= $vite->importCss('resources/css/admin.css') ?>
<?= $vite->importJs('resources/js/entrypoints/admin/app.ts') ?>
