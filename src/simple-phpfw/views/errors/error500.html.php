<?= $this->render('errors.begin') ?>

<main>
    <h2>500 Error</h2>
    <?= $this->render('errors.partials.trace', $data) ?>
</main>

<?= $this->render('errors.end') ?>