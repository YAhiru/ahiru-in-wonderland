<?php
declare(strict_types=1);
namespace Wonderland\Domain\Model;

abstract class AbstractIdentifier implements Identifier
{
    /** @var string */
    protected $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function equals(Identifier $id) : bool
    {
        return $this->getValue() === $id->getValue()
            && get_class($this) === get_class($id);
    }

    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return static
     */
    public static function of(string $value) : Identifier
    {
        return new static($value);
    }
}
