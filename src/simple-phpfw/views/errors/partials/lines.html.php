<?php

use SFW\Data\File;

$lines = File::getLinesAround($srcPath, $srcLine - 1);

$html = '';
foreach ($lines as $idx => $line) {
    $num = $idx + 1;
    $lineClass = $srcLine === $num ? 'active' : '';
    $html .= "<div class='$lineClass'>";
    $html .=    "<span class='number'>$num:</span><span class='text'>" . $this->h($line) . "</span>\n";
    $html .= "</div>";
}
?>
<pre class="trace-exception-lines"><?= $html ?></pre>