<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Monster;

final class Monster
{
    private MonsterId $id;
    private string $name;
    private Level $level;
    private HitPoint $hitPoint;
    private MagicPoint $magicPoint;

    public function __construct(MonsterId $id, string $name, Level $level, HitPoint $hitPoint, MagicPoint $magicPoint)
    {
        $this->id = $id;
        $this->name = $name;
        $this->level = $level;
        $this->hitPoint = $hitPoint;
        $this->magicPoint = $magicPoint;
    }

    public function getId() : MonsterId
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getLevel() : Level
    {
        return $this->level;
    }

    public function getCurrentHitPoint() : int
    {
        return $this->hitPoint->getCurrent();
    }

    public function getCurrentMagicPoint() : int
    {
        return $this->magicPoint->getCurrent();
    }
}
