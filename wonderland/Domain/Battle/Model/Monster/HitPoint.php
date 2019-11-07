<?php
declare(strict_types=1);

namespace Wonderland\Domain\Battle\Model\Monster;

final class HitPoint
{
    /** @var int */
    private $max;
    /** @var int */
    private $current;

    public function __construct(int $max, int $current)
    {
        $this->max = $max;
        $this->current = $current;
    }
}
