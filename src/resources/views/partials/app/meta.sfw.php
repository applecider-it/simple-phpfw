<?php

use SFW\Core\Config;
?>
<meta name="app" data-json="{{ json_encode([
                                'prefix' => Config::get('prefix'),
                            ]) }}">