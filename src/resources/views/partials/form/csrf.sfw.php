<?php

use SFW\Web\Csrf;
?>
<input type="hidden" name="csrf_token" value="{{ Csrf::get() }}">