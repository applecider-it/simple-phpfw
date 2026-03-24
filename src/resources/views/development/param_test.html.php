<h2 class="app-h2">development.param_test</h2>
<div>
    <div>$data['id'] <?= $this->h($data['id']) ?></div>
    <div>$data['val1'] <?= $this->h($data['val1']) ?></div>
</div>
<div style="margin-top: 5rem;">
    <form method="POST" action="<?= $this->h($this->route('development.param_test', ['id' => 'xyz'])) ?>">
        <?= $this->render('partials.form.csrf') ?>

        <input type="text" name="val1" value="バリュー１">
        <button type="submit">送信</button>
    </form>
</div>