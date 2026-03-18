<?php

use SFW\Web\Csrf;
?>
<meta name="csrf-token" content="{{ Csrf::get() }}">