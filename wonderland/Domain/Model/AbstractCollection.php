<?php
declare(strict_types=1);
namespace Wonderland\Domain\Model;

abstract class AbstractCollection implements Collection
{
    /** @var array */
    protected $items;

    protected function __construct(array $items)
    {
        $this->items = $items;
    }

    public function isEmpty() : bool
    {
        return ! $this->items;
    }

    public function isNotEmpty() : bool
    {
        return $this->isEmpty();
    }

    public function count() : int
    {
        return count($this->items);
    }

    /**
     * @param callable $callable
     *
     * @return static
     */
    protected function filter(callable $callable) : self
    {
        return new static(array_filter($this->items, $callable));
    }

    protected function map(callable $callable) : array
    {
        return array_map($callable, $this->items);
    }
}
