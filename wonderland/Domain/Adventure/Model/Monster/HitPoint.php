<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Monster;

final class HitPoint
{
    /** @var int */
    private $current;
    /** @var int */
    private $max;

    public function __construct(int $current, int $max)
    {
        $this->current = $current;
        $this->max = $max;
    }

    public function getCurrent() : int
    {
        return $this->current;
    }

    public function getMax() : int
    {
        return $this->max;
    }
}
