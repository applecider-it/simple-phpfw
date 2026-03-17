<?php

declare(strict_types=1);

namespace SFW\Output\View\Template;

/**
 * SFW用テンプレート管理
 */
class SfwTemplate
{
    /**
     * テンプレートを作成
     */
    public function createTemplate(string $path): ?array
    {
        $name = basename($path);
        $tmpPath = SFW_PROJECT_ROOT . '/storage/views/' . md5($path) . '_' . $name;

        if (!file_exists($tmpPath)) {
            $templateData = file_get_contents($path);
            $resultTemplateData = $this->convertTemplate($templateData);
            echo '<pre>' . \SFW\Output\Html::esc(print_r([$path, $tmpPath, $resultTemplateData], true)) . '</pre>';
        }

        return [
            'path' => $path,
            'srcPath' => $path,
        ];
    }

    /**
     * テンプレート変換
     * 
     * {{ $val }} -> <?= \SFW\Output\Html::esc($val) ?>
     * {!! $val !!} -> <?= $val ?>
     */
    private function convertTemplate(string $templateData): string
    {
        $templateData = preg_replace(
            '/\{\{\s*(.*?)\s*\}\}/',
            '<?= \SFW\Output\Html::esc($1) ?>',
            $templateData
        );

        $templateData = preg_replace(
            '/\{\!\!\s*(.*?)\s*\!\!\}/',
            '<?= $1 ?>',
            $templateData
        );

        return $templateData;
    }
}
