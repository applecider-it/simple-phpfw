<?php

declare(strict_types=1);

namespace SFW\Exceptions;

/**
 * Viewで発生した例外
 */
class View extends \Exception
{
    private array $meta;

    public function __construct(array $meta, \Throwable $previous)
    {
        $this->meta = $meta;

        parent::__construct('View Exception', 0, $previous);
    }

    public function meta(): array
    {
        return $this->meta;
    }
}
