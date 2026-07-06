<?php

use SFW\Core\App;

$vite = App::get('vite');
?>
<script type="module" src="<?= $this->h($vite->asset('resources/js/entrypoints/tweet.ts')) ?>"></script>

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