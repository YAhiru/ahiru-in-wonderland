<?php
declare(strict_types=1);
namespace Wonderland\Domain\Model\Player;

use Wonderland\Domain\Adventure\Model\Battle\Battle;
use Wonderland\Domain\Adventure\Model\Battle\BattleId;
use Wonderland\Domain\Adventure\Model\Battle\Enemies;
use Wonderland\Domain\Adventure\Model\Monster\Monsters;

final class Player
{
    /** @var PlayerId */
    private $playerId;
    /** @var Monsters */
    private $monsters;

    public function __construct(PlayerId $playerId, Monsters $monsters)
    {
        $this->playerId = $playerId;
        $this->monsters = $monsters;
    }

    public function encounter(BattleId $battleId, Enemies $enemies) : Battle
    {
        return new Battle(
            $battleId,
            $this->playerId,
            $this->monsters,
            $enemies
        );
    }
}
