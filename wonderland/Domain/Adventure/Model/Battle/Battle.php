<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Battle;

use Wonderland\Domain\Adventure\Model\Monster\Monsters;
use Wonderland\Domain\Model\Player\PlayerId;

final class Battle
{
    /** @var BattleId */
    private $id;
    /** @var PlayerId */
    private $playerId;
    /** @var Monsters */
    private $monsters;
    /** @var Enemies */
    private $enemies;

    public function __construct(BattleId $id, PlayerId $playerId, Monsters $monsters, Enemies $enemies)
    {
        $this->id = $id;
        $this->playerId = $playerId;
        $this->monsters = $monsters;
        $this->enemies = $enemies;
    }

    public function getId() : BattleId
    {
        return $this->id;
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
