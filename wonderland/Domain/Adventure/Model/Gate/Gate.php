<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate;

use Wonderland\Domain\Adventure\Model\Battle\Enemies;

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

    public function makeEnemies() : Enemies
    {
        return $this->encountableMonsters->encount();
    }
}
