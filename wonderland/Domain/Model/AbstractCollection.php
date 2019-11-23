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
}
