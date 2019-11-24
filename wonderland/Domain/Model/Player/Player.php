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
    private $id;
    /** @var Monsters */
    private $monsters;

    public function __construct(PlayerId $id, Monsters $monsters)
    {
        $this->id = $id;
        $this->monsters = $monsters;
    }

    public function encounter(BattleId $battleId, Enemies $enemies) : Battle
    {
        return new Battle(
            $battleId,
            $this->id,
            $this->monsters,
            $enemies
        );
    }
}
