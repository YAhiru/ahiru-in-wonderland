<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate\Encountable;

use Wonderland\Domain\Model\ConstructException;

final class FloorRange
{
    /** @var int */
    private $min;
    /** @var int */
    private $max;

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

    public function isInclude(int $floor) : bool
    {
        return $this->min <= $floor
            && $this->max >= $floor;
    }
}
