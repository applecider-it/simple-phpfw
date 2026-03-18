<?php

declare(strict_types=1);

namespace SFW\Output\View;

use SFW\Output\View;

use SFW\Output\View\Template\SfwTemplate;

/**
 * テンプレート管理
 */
class Template
{
    /** View管理 */
    private View $view;

    /** SFW用テンプレート管理 */
    private array $templates = [];

    /** テンプレートファイルタイプリスト */
    private const FILE_TYPES = [
        'html', // HTMLテンプレート

        'sfw.blade',    // 独自テンプレート（.bladeをつけないとエディタエラーが出る）
    ];

    function __construct(View $view)
    {
        $this->view = $view;

        $this->templates['sfw.blade'] = new SfwTemplate;
    }

    /** 描画情報を返す */
    public function renderInfo(string $name): array
    {
        $baseDir = $this->view->baseDir() ?? SFW_PROJECT_ROOT . '/resources/views';

        $templateResult = $this->findTemplate($baseDir, $name);

        if (!$templateResult)
            throw new \Exception("View not found: $name.");

        $meta = compact('name', 'baseDir') + $templateResult;

        return $meta;
    }

    /** テンプレートを探す */
    private function findTemplate(string $baseDir, string $name): ?array
    {
        foreach (self::FILE_TYPES as $type) {
            $path = $baseDir . '/' . str_replace('.', '/', $name) . '.' . $type . '.php';
            if (file_exists($path)) {
                return compact('type') + $this->getPathInfo($path, $type);
            }
        }

        return null;
    }

    /** パス情報を返す */
    private function getPathInfo(string $path, string $type): ?array
    {
        if ($type !== 'html') {
            return $this->getGenartedPathInfo($path, $type);
        }

        return compact('path');
    }

    /** テンポラリーファイルなどを含んだパス情報を返す */
    private function getGenartedPathInfo(string $path, string $type): ?array
    {
        /** @var string テンポラリーファイルパス */
        $tmpPath = SFW_PROJECT_ROOT . '/storage/views/' . $this->tempFileName($path);

        $needGenerate = $this->checkGenarate($path, $tmpPath);

        if ($needGenerate) {
            // テンポラリーファイル生成が必要な時

            $templateData = file_get_contents($path);
            $resultTemplateData = $this->templates[$type]->convertTemplate($templateData);
            file_put_contents($tmpPath, $resultTemplateData);

            //echo "create";
        }

        return [
            'path' => $tmpPath,
            'srcPath' => $path,
        ];
    }

    /** 生成が必要か返す */
    private function checkGenarate(string $path, string $tmpPath): bool
    {
        if (!file_exists($tmpPath)) {
            // テンポラリーファイルがないとき

            return true;
        }

        if (filemtime($tmpPath) < filemtime($path)) {
            // テンポラリーファイルより、ソースファイルの更新日時が新しいとき

            return true;
        }

        return false;
    }

    /** テンポラリーファイル名 */
    private function tempFileName(string $path): string
    {
        $name = basename($path);
        $dir = basename(dirname($path));

        $info = pathinfo($name);
        $fileName = $info['filename'];
        $extension  = $info['extension'];

        $tempFileName = $dir . '__' . $fileName . '__' . md5($path) . '.' . $extension;

        return $tempFileName;
    }
}
