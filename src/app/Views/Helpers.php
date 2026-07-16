<?php

namespace App\Views;

/**
 * ヘルパー関数
 */
trait Helpers
{
    /**
     * サンプルヘルパー関数
     */
    protected function sampleHelperFunction(string $name): string
    {
        return '<<< ' . $name . ' >>>';
    }
}
