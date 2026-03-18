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

    /** テンプレート管理 */
    private View\Template $template;

    function __construct()
    {
        $this->template = new View\Template($this);
    }

    /**
     * 描画して文字列を返す
     */
    public function render(string $name, array $data = []): string
    {
        $meta = $this->template->renderInfo($name);

        return $this->includeTemplate($meta, $data);
    }

    /**
     * アウトバッファーを使い、テンプレート読み込み
     */
    private function includeTemplate(array $meta, array $data): string
    {
        // 変数を退避
        $___sfw__view__keep = [
            'meta' => $meta,
            'data' => $data,
        ];

        // 変数を展開
        extract($data);

        // 戻す
        // $data, $meta変数は上書きされるので注意！
        $data = $___sfw__view__keep['data'];
        $meta = $___sfw__view__keep['meta'];

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
