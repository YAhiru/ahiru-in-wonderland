<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate;

use Wonderland\Domain\Adventure\Model\Battle\Enemies;
use Wonderland\Domain\Adventure\Model\Monster\HitPoint;
use Wonderland\Domain\Adventure\Model\Monster\MagicPoint;
use Wonderland\Domain\Adventure\Model\Monster\Monster;

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
            new Monster('1', 'monster1', 1, new HitPoint(30, 30), new MagicPoint(15, 15)),
            new Monster('2', 'monster2', 1, new HitPoint(30, 30), new MagicPoint(15, 15))
        );
    }
}
