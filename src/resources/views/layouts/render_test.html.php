<?php

use SFW\Output\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body class="app-layout-body">
    <?= $this->render('layouts.partials.common') ?>
    <?= $this->render('layouts.partials.nav') ?>

    <div>layouts.render_test</div>

    <main class="app-layout-main">
        <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
    </main>
</body>

</html>