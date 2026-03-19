<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head') ?>
</head>

<body>
    <?= $this->render('layouts.partials.nav') ?>

    <main>
        <h2>500 Error</h2>
        <?php if ($data['e'] instanceof SFW\Exceptions\View): ?>
            <?php $meta = $data['e']->meta(); ?>
            <?php $previous = $data['e']->getPrevious(); ?>
            <?php $srcPath = $meta['srcPath'] ?? null; ?>

            <div>View Error</div>
            <?php if ($srcPath): ?>
                <div>Source: <?= $this->h($srcPath) ?></div>
                <div>Exception: <?= $this->h($previous->getFile()) ?> (<?= $previous->getLine() ?>)</div>
            <?php endif; ?>
            <pre class="description"><?= $this->h($previous) ?></pre>
        <?php else: ?>
            <pre class="description"><?= $this->h($data['e']) ?></pre>
        <?php endif; ?>
    </main>

    <?= $this->render('layouts.partials.footer') ?>
</body>

</html>