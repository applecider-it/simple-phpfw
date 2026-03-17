<?php

declare(strict_types=1);

namespace SFW\Output;

/**
 * View管理
 */
class View
{
    /** 基準となるディレクトリパス。nullだとresources/viewsになる。 */
    private ?string $baseDir = null;

    /** 共通変数 */
    private array $data = [];

    /** View情報管理 */
    private View\Info $info;

    function __construct()
    {
        $this->info = new View\Info($this);
    }

    /**
     * 描画して文字列を返す
     */
    public function render(string $name, array $data = []): string
    {
        $meta = $this->info->renderInfo($name);

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
     * 基準となるディレクトリパス
     */
    public function baseDir(): ?string
    {
        return $this->baseDir;
    }

    /**
     * 共通変数追加
     */
    public function appendCommonData(array $data): void
    {
        $this->data = $data + $this->data;
    }
}
