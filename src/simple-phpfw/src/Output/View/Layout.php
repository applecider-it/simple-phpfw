<?php

declare(strict_types=1);

namespace SFW\Output\View;

use SFW\Output\View;

/**
 * Viewのレイアウト管理
 */
class Layout
{
    /** レイアウトに渡すデータのキー */
    public const KEY_LAYOUT_OPTIONS = '___SFW_LAYOUT_OPTIONS';

    /** レイアウトコンテンツのキー */
    public const KEY_LAYOUT_CONTENT = '___SFW_LAYOUT_CONTENT';

    /**
     * レイアウト付きで描画して文字列を返す
     */
    public static function renderWithLayout(
        View $view,
        string $name,
        array $data = [],
        ?string $layout = null,
        array $layoutData = [],
        array $globalData = []
    ): string {
        $view->appendCommonData($globalData);

        // レイアウトに渡す値
        //（オブジェクトにすることで参照渡しになるので、$nameのテンプレートからレイアウトに値を渡せる）
        $layoutOptions = new \stdClass;

        $data[self::KEY_LAYOUT_OPTIONS] = $layoutOptions;

        $val = $view->render($name, $data);

        if ($layout) {
            // レイアウトの指定があるとき

            $val = $view->render($layout, [
                self::KEY_LAYOUT_CONTENT => $val,
                self::KEY_LAYOUT_OPTIONS => $data[self::KEY_LAYOUT_OPTIONS],
            ] + $layoutData);
        }

        return $val;
    }
}
