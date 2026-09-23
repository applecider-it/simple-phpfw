<?php

use SFW\Core\App;

$vite = App::get('vite');

$list = [
    '/images/Block.png',
    '/images/Block.png',
    '/images/Block.png',
    '/images/Block.png',
];
?>

<?= $vite->importJs('resources/js/entrypoints/development/javascript-test.ts') ?>

<h2 class="app-h2">development.javascript_test</h2>
<div class="space-y-4">
    <div id="vue"
        data-all="<?= $this->h(json_encode([
                        'valueTest' => compact('value1'),
                    ])) ?>">
    </div>

    <div>
        <h3 class="app-h3">swiper</h3>
        <div class="mt-5">
            <?= $this->render('partials.ui.slide-show', ['list' => $list]) ?>
        </div>
        <div class="mt-5">
            <?= $this->render('partials.ui.slide-show', ['list' => $list]) ?>
        </div>
    </div>
</div>