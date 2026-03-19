<#php

namespace App\Controllers{{ $data['controllerNamespace'] ? '\\' . $data['controllerNamespace'] : '' }};

<?php if ($data['controllerNamespace']): ?>

use App\Controllers\Controller;
<?php endif; ?>

/**
 * {{ $data['controllerName'] . "\n" }}
 */
class {{ $data['controllerName'] }}Controller extends Controller
{
<?php foreach ($data['actions'] as $idx => $action): ?>
{{ $idx == 0 ? '' : "\n" }}
    /** {{ $action }} */
    public function {{ $action }}()
    {
        return $this->render('{{ $data['viewPrefix'] }}.{{ $action }}');
    }
<?php endforeach; ?>
}
