<?= $this->render('errors.begin') ?>

<main>
    <h2>404 Error</h2>
    <?= $this->render('errors.partials.trace', $data) ?>
</main>

<?= $this->render('errors.end') ?>