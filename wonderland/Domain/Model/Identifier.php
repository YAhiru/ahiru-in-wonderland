<?php
declare(strict_types=1);
namespace Wonderland\Domain\Model;

interface Identifier
{
    public function equals(self $id) : bool;

    public function value() : string;
}
