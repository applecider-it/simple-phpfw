<?php

declare(strict_types=1);

namespace SFW\Output\View\Template;

/**
 * SFW用テンプレート管理
 */
class SfwTemplate extends Base
{
    /**
     * パス情報を返す
     */
    public function getPathInfo(string $path): ?array
    {
        /** @var string テンポラリーファイルパス */
        $tmpPath = SFW_PROJECT_ROOT . '/storage/views/' . $this->tempFileName($path);

        $needGenerate = $this->checkGenarate($path, $tmpPath);

        if ($needGenerate) {
            // テンポラリーファイル生成が必要な時

            $templateData = file_get_contents($path);
            $resultTemplateData = $this->convertTemplate($templateData);
            file_put_contents($tmpPath, $resultTemplateData);

            //echo "create";
        }

        return [
            'path' => $tmpPath,
            'srcPath' => $path,
        ];
    }

    /**
     * テンプレート変換
     * 
     * {{ $val }} -> <?= \SFW\Output\Html::esc($val) ?>
     */
    private function convertTemplate(string $templateData): string
    {
        $templateData = preg_replace(
            '/\{\{\s*(.*?)\s*\}\}/',
            '<?= \SFW\Output\Html::esc($1) ?>',
            $templateData
        );

        return $templateData;
    }
}
