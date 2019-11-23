<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Battle;

use Wonderland\Domain\Adventure\Model\Monster\Monsters;
use Wonderland\Domain\Model\Player\PlayerId;

final class Battle
{
    /** @var BattleId */
    private $battleId;
    /** @var PlayerId */
    private $playerId;
    /** @var Monsters */
    private $monsters;
    /** @var Enemies */
    private $enemies;

    public function __construct(BattleId $battleId, PlayerId $playerId, Monsters $monsters, Enemies $enemies)
    {
        $this->battleId = $battleId;
        $this->playerId = $playerId;
        $this->monsters = $monsters;
        $this->enemies = $enemies;
    }

    public function getBattleId() : BattleId
    {
        return $this->battleId;
    }

    public function getPlayerId() : PlayerId
    {
        return $this->playerId;
    }

    public function getMonsters() : Monsters
    {
        return $this->monsters;
    }

    public function getEnemies() : Enemies
    {
        return $this->enemies;
    }
}
