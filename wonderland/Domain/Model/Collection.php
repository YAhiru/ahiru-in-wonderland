<?php
declare(strict_types=1);
namespace Wonderland\Domain\Model;

interface Collection
{
    public function isEmpty() : bool;

    public function isNotEmpty() : bool;

    public function count() : int;
}
