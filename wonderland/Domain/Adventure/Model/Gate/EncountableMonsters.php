<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate;

use Wonderland\Domain\Adventure\Model\Battle\Enemies;
use Wonderland\Domain\Adventure\Model\Monster\HitPoint;
use Wonderland\Domain\Adventure\Model\Monster\Level;
use Wonderland\Domain\Adventure\Model\Monster\MagicPoint;
use Wonderland\Domain\Adventure\Model\Monster\Monster;
use Wonderland\Domain\Adventure\Model\Monster\MonsterId;

final class EncountableMonsters
{
    /** @var EncountableMonster[] */
    private $monsters;

    public function __construct(EncountableMonster ...$monsters)
    {
        $this->monsters = $monsters;
    }

    public function encount() : Enemies
    {
        return Enemies::create(
            new Monster(MonsterId::of('1'), 'monster1', Level::of(1), HitPoint::of(30, 30), MagicPoint::of(15, 15)),
            new Monster(MonsterId::of('2'), 'monster2', Level::of(1), HitPoint::of(30, 30), MagicPoint::of(15, 15))
        );
    }
}
