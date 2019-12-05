<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Monster;

use Wonderland\Domain\Model\ConstructException;

final class HitPoint
{
    private int $current;
    private int $max;

    private function __construct(int $current, int $max)
    {
        if ($current > $max) {
            throw new ConstructException('$current must be less than or equal to $max. but given $current=' . $current . ' $max=' . $max);
        }

        $this->setCurrent($current);
        $this->setMax($max);
    }

    public static function of(int $current, int $max) : self
    {
        return new self($current, $max);
    }

    public function getCurrent() : int
    {
        return $this->current;
    }

    public function getMax() : int
    {
        return $this->max;
    }

    private function setCurrent(int $current) : void
    {
        if ($current < 0) {
            throw new ConstructException('$current must be greater than 0. but given ' . $current);
        }
        $this->current = $current;
    }

    private function setMax(int $max) : void
    {
        if ($max > 999) {
            throw new ConstructException('HitPoint must be less than 1000. but given ' . $max);
        }
        if ($max < 1) {
            throw new ConstructException('$max must be greater than 1. but given ' . $max);
        }
        $this->max = $max;
    }
}
