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
        <div class="swiper-container swiper-container1">
            <div class="swiper swiper1">
                <div class="swiper-wrapper">
                    <?php foreach ($list as $val): ?>
                        <div class="swiper-slide">
                            <Image src="<?= $this->h($val) ?>" alt="" class="mx-auto" />
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-pagination swiper-pagination1"></div>
            </div>
        </div>
    </div>
</div>