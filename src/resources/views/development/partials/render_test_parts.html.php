<?php

use function SFW\Helpers\html_esc as h;

$metaStyle = $data['metaStyle'];
?>
<h3 class="app-h3" style="margin-top: 1rem;">development.partials.render_test_parts</h3>

<div style="<?= h($metaStyle) ?>">
    <div>$meta['name']: <?= h($meta['name']) ?></div>
    <div>$meta['baseDir']: <?= h($meta['baseDir']) ?></div>
    <div>$meta['path']: <?= h($meta['path']) ?></div>
    <div>$meta['type']: <?= h($meta['type']) ?></div>
</div>

<div>$this->data['id'] <?= h($this->data['id']) ?></div>
<div>$data['id'] <?= h($data['id'] ?? 'none') ?></div>
<div>$data['val1'] <?= h($data['val1']) ?></div>
<div>$id <?= h($id ?? 'none') ?></div>
<div>$val1 <?= h($val1) ?></div>