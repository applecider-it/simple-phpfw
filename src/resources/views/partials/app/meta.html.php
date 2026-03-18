<?php

use SFW\Core\Config;
use SFW\Output\Html;
?>
<meta name="app" data-json="<?= Html::esc(json_encode([
                                'prefix' => Config::get('prefix'),
                            ])) ?>">