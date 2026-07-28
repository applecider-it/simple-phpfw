<?php

use SFW\Core\App;

$vite = App::get('vite');
?>

<?= $vite->importJs('resources/js/entrypoints/chat.ts') ?>

<h2 class="app-h2">チャット ( room: <?= $this->h($rooms[$room]) ?> )</h2>

<div>
    <div class="space-x-4">
        <?php foreach ($rooms as $key => $val): ?>
            <?php if ($key === $room): ?>
                <span><?= $this->h($val) ?></span>
            <?php else: ?>
                <a href="<?= $this->route('chat.index', ['room' => $key]) ?>" class="app-link-normal"><?= $this->h($val) ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div class="my-4">
        <div id="chat-root"
            data-all="<?= $this->h(json_encode([
                            'urls' => [
                                'store' => $this->route('chat.store'),
                            ],
                            'room' => $room,
                        ])) ?>">
        </div>
    </div>
</div>