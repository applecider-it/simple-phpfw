<?php

$array = $errors[$attribute] ?? null;
?>
<?php if ($array): ?>
    <ul style="margin-top:0.5rem; padding-left: 1.2rem; color: #c0392b;">
        <?php foreach ($array as $val): ?>
            <li><?= $this->h($val) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>