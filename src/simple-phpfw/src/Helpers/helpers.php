<?php

declare(strict_types=1);

namespace SFW\Helpers;

use SFW\Core\App;

/** ルート取得 */
function route(string $name, array $data = []): string
{
    /** @var \SFW\Web\Router */
    $router = App::get('router');
    return $router->route($name, $data);
}
