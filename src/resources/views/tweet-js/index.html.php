<?php

use SFW\Core\App;

$vite = App::get('vite');
?>
<script type="module" src="<?= $this->h($vite->asset('resources/js/entrypoints/tweet.ts')) ?>"></script>

<div>
    <div id="tweet-root"></div>
</div>