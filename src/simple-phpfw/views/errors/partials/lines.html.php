<?php

use SFW\Data\File;

$lines = File::getLinesAround($srcPath, $srcLine - 1);

$html = '';
foreach ($lines as $idx => $line) {
    $num = $idx + 1;
    $lineClass = $srcLine === $num ? 'active' : '';
    $html .= "<div class='$lineClass'>";
        $html .= "<span>$num:</span>" . $this->h($line) . "\n";
    $html .= "</div>";
}
?>
<pre class="trace-exception-lines"><?= $html ?></pre>