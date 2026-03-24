<#php

namespace App\Controllers<?= $this->h($data['controllerNamespace'] ? '\\' . $data['controllerNamespace'] : '') ?>;

<?php if ($data['controllerNamespace']): ?>

use App\Controllers\Controller;
<?php endif; ?>

/**
 * <?= $this->h($data['controllerName'] . "\n") ?>
 */
class <?= $this->h($data['controllerName']) ?>Controller extends Controller
{
<?php foreach ($data['actions'] as $idx => $action): ?>
<?= $this->h($idx == 0 ? '' : "\n") ?>
    /** <?= $this->h($action) ?> */
    public function <?= $this->h($action) ?>()
    {
        return $this->render('<?= $this->h($data['viewPrefix']) ?>.<?= $this->h($action) ?>');
    }
<?php endforeach; ?>
}
