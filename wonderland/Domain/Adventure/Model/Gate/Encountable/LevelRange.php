<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate\Encountable;

use Wonderland\Domain\Adventure\Model\Monster\Level;
use Wonderland\Domain\Model\ConstructException;

final class LevelRange
{
    private int $min;
    private int $max;

    private function __construct(int $min, int $max)
    {
        if ($min > $max) {
            throw new ConstructException(sprintf('$max must be greater than or equal to $min. but given $min:%d, $max:%d', $min, $max));
        }
        $this->min = $min;
        $this->max = $max;
    }

    public static function create(int $min, int $max) : self
    {
        return new self($min, $max);
    }

    /**
     * @throws \Exception
     *
     * @return Level
     */
    public function random() : Level
    {
        return Level::of(random_int($this->min, $this->max));
    }

    public function getMin() : int
    {
        return $this->min;
    }

    public function getMax() : int
    {
        return $this->max;
    }
}
