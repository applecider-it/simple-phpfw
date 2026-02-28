<?php

declare(strict_types=1);

namespace SFW\Output;

use SFW\Core\Config;

/**
 * View管理
 */
class View
{
    /** テンプレートファイルのポストフィックス */
    private const FILE_POSTFIX = '.html.php';

    /** 基準となるディレクトリパス。nullだとresources/viewsになる。 */
    private ?string $baseDir = null;

    /** 共通変数 */
    private array $data = [];

    /**
     * 描画して文字列を返す
     */
    public function render(string $name, array $data = []): string
    {
        $baseDir = $this->baseDir ?? SFW_PROJECT_ROOT . '/resources/views';
        $path = $baseDir . '/' . str_replace('.', '/', $name) . self::FILE_POSTFIX;

        if (!file_exists($path)) {
            throw new \Exception("View not found: $name. path: $path.");
        }

        $meta = [
            'name' => $name,
            'baseDir' => $baseDir,
            'path' => $path,
        ];

        return $this->includeTemplate($meta, $data);
    }

    /**
     * アウトバッファーを使い、テンプレート読み込み
     */
    private function includeTemplate(array $meta, array $data): string
    {
        // $dataはインクルード先で利用している

        ob_start();
        try {
            include $meta['path'];
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }
        $val = ob_get_clean();

        return $val;
    }

    /**
     * 基準となるディレクトリパスを設定
     */
    public function setBaseDir(string $baseDir): void
    {
        $this->baseDir = $baseDir;
    }

    /**
     * 共通変数追加
     */
    public function appendCommonData(array $data): void
    {
        $this->data = $data + $this->data;
    }
}
