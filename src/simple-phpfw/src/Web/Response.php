<?php

declare(strict_types=1);

namespace SFW\Web;

/**
 * レスポンス管理
 */
class Response
{
    /** 処理できないエンティティ (入力エラー) */
    public const int CODE_UNPROCESSABLE_ENTITY = 422;

    /** インターナルサーバーエラー */
    public const int CODE_INTERNAL_SERVER_ERROR = 500;

    /** ページが見つからない */
    public const int CODE_NOT_FOUND = 404;

    /** HTTPレスポンスコード */
    public static function code(int $code): void
    {
        $conf = [
            self::CODE_UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
        ];

        if (isset($conf[$code])) {
            header('HTTP/1.1 ' . $code . ' ' . $conf[$code]);
        } else {
            http_response_code($code);
        }
    }
}
