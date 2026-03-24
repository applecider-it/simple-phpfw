<?php

use SFW\Web\Flash;
?>
<?php if (Flash::get('notice')): ?>
    <ul style="margin:1rem 0; padding-left: 1.2rem; color: #3498db;">
        <li><?= $this->h(Flash::get('notice')) ?></li>
    </ul>
<?php endif; ?>

<?php if (Flash::get('alert')): ?>
    <ul style="margin:1rem 0; padding-left: 1.2rem; color: #ff3333;">
        <li><?= $this->h(Flash::get('alert')) ?></li>
    </ul>
<?php endif; ?>
