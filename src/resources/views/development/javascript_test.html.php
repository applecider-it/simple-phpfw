<?php

use SFW\Core\App;

$vite = App::get('vite');
?>

<?= $vite->importJs('resources/js/entrypoints/development/javascript-test.ts') ?>

<h2 class="app-h2">development.javascript_test</h2>
<div>
    <div id="vue"
        data-all="<?= $this->h(json_encode([
                        'valueTest' => compact('value1'),
                    ])) ?>">
    </div>
</div>