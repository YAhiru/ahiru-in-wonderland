<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate;

use Wonderland\Domain\Adventure\Model\Battle\Enemies;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EmptyEncountException;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsters;

final class Gate
{
    /** @var GateId */
    private $id;
    /** @var EncountableMonsters */
    private $encountableMonsters;
    /** @var int */
    private $topFloor;

    public function __construct(GateId $id, EncountableMonsters $encountableMonsters, int $topFloor)
    {
        $this->id = $id;
        $this->encountableMonsters = $encountableMonsters;
        $this->topFloor = $topFloor;
    }

    public function getId() : GateId
    {
        return $this->id;
    }

    public function makeEnemies(int $targetFloor, int $count) : Enemies
    {
        $encountables = $this->encountableMonsters->filterTargetFloor($targetFloor);
        if ($encountables->isEmpty()) {
            throw new EmptyEncountException('Monster does not exists in the floor. floor: ' . $targetFloor);
        }

        $ids = $encountables->getIds();
        $enemies = [];
        while ($count--) {
            $enemies[] = $encountables->createEnemy($ids[array_rand($ids)]);
        }

        return Enemies::create(...$enemies);
    }
}
