<?php
declare(strict_types=1);
namespace Wonderland\Domain\Model\Player;

use Wonderland\Domain\Adventure\Model\Battle\Battle;
use Wonderland\Domain\Adventure\Model\Battle\BattleId;
use Wonderland\Domain\Adventure\Model\Battle\Enemies;
use Wonderland\Domain\Adventure\Model\Monster\Monsters;

final class Player
{
    private PlayerId $id;
    private Monsters $monsters;

    public function __construct(PlayerId $id, Monsters $monsters)
    {
        $this->id = $id;
        $this->monsters = $monsters;
    }

    public function encounter(Enemies $enemies, BattleId $battleId) : Battle
    {
        return new Battle(
            $battleId,
            $this->id,
            $this->monsters,
            $enemies
        );
    }
}
