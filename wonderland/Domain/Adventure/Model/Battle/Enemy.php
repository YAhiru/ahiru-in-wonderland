<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Battle;

use Wonderland\Domain\Adventure\Model\Monster\Level;

final class Enemy
{
    /** @var string */
    private string $name;
    /** @var Level */
    private Level $level;

    public function __construct(string $name, Level $level)
    {
        $this->name = $name;
        $this->level = $level;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getLevel() : Level
    {
        return $this->level;
    }
}
