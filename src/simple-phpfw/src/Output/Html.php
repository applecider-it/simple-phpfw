<?php

declare(strict_types=1);

namespace SFW\Output;

use SFW\Core\Config;

/**
 * HTML関連
 */
class Html
{
    /** エスケープ */
    public static function esc(mixed $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}
