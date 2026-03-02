<?php

declare(strict_types=1);

namespace SFW\Web;

/**
 * レスポンス管理
 */
class Response
{
    /** HTTPレスポンスコード */
    public static function code(int $code): void
    {
        $conf = [
            422 => 'Unprocessable Entity',
        ];

        if (isset($conf[$code])) {
            header('HTTP/1.1 ' . $code . ' ' . $conf[$code]);
        } else {
            http_response_code($code);
        }
    }
}
