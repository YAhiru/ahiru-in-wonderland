<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Monster;

use Wonderland\Domain\Model\ConstructException;

final class Level
{
    /** @var int */
    private $value;

    private function __construct(int $value)
    {
        $this->setValue($value);
    }

    public static function of(int $value) : self
    {
        return new self($value);
    }

    public function getValue() : int
    {
        return $this->value;
    }

    private function setValue(int $value) : void
    {
        if ($value < 1) {
            throw new ConstructException('Level must be positive number. but given ' . $value);
        }
        if ($value > 99) {
            throw new ConstructException('Level must be smaller than 100. but given ' . $value);
        }
        $this->value = $value;
    }
}
