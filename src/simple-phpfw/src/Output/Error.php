<?php

declare(strict_types=1);

namespace SFW\Output;

use SFW\Web\Response;

/**
 * エラー表示関連
 */
class Error
{
    /** 500エラー表示 */
    public static function error500(\Throwable $e): void
    {
        $view = View\Factory::errorView();
        echo $view->render('errors.error500', [
            'e' => $e,
        ]);
        Response::code(Response::CODE_INTERNAL_SERVER_ERROR);
    }

    /** 404エラー表示 */
    public static function error404(\Throwable $e): void
    {
        $view = View\Factory::errorView();
        echo $view->render('errors.error404', [
            'e' => $e,
        ]);
        Response::code(Response::CODE_NOT_FOUND);
    }
}
