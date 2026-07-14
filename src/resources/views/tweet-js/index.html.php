<?php

use SFW\Core\App;

$vite = App::get('vite');
?>

<?= $vite->importJs('resources/js/entrypoints/tweet.ts') ?>

<div>
    <div id="tweet-root"
        data-all="<?= $this->h(json_encode([
                        'urls' => [
                            'list' => $this->route('tweets-js.list'),
                            'store' => $this->route('tweets-js.store'),
                        ],
                    ])) ?>">
    </div>
</div>