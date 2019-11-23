<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate;

use Wonderland\Domain\Adventure\Model\Battle\Enemies;

final class Gate
{
    /** @var GateId */
    private $gateId;
    /** @var EncountableMonsters */
    private $encountableMonsters;
    /** @var int */
    private $topFloor;

    public function __construct(GateId $gateId, EncountableMonsters $encountableMonsters, int $topFloor)
    {
        $this->gateId = $gateId;
        $this->encountableMonsters = $encountableMonsters;
        $this->topFloor = $topFloor;
    }

    public function getGateId() : GateId
    {
        return $this->gateId;
    }

    public function makeEnemies() : Enemies
    {
        return $this->encountableMonsters->encount();
    }
}
