<?php

use SFW\Core\App;

$vite = App::get('vite');
?>

<?= $vite->importJs('resources/js/entrypoints/chat.ts') ?>

<div>
    <div id="chat-root"
        data-all="<?= $this->h(json_encode([
                        'urls' => [
                            'store' => $this->route('chat.store'),
                        ],
                    ])) ?>">
    </div>
</div>