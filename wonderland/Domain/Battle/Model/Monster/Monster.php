<?php
declare(strict_types=1);
namespace Wonderland\Domain\Battle\Model\Monster;

final class Monster
{
    private $name;
    private $level;
    /** @var Abilities */
    private $abilities;
    private $skills;

    public function __construct($name, $level, Abilities $abilities, $skills)
    {
        $this->name = $name;
        $this->level = $level;
        $this->abilities = $abilities;
        $this->skills = $skills;
    }
}
