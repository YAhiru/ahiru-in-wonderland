<?php
declare(strict_types=1);
namespace Wonderland\Domain\Breeding\Model\Monster;

final class Monster
{
    private $name;
    private $type;
    private $sex;

    public function __construct($name, $type, $sex)
    {
        $this->name = $name;
        $this->type = $type;
        $this->sex = $sex;
    }
}
