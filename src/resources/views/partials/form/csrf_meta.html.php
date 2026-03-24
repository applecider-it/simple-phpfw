<?php

use SFW\Web\Csrf;
?>
<meta name="csrf-token" content="<?= $this->h(Csrf::get()) ?>">