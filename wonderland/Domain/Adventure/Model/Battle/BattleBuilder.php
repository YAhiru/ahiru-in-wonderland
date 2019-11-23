<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Battle;

use Wonderland\Domain\Adventure\Model\Monster\Monsters;
use Wonderland\Domain\Model\Player\PlayerId;

final class BattleBuilder
{
    public static function fromArray(array $data) : Battle
    {
        return new Battle(
            BattleId::of($data['battle_id']),
            PlayerId::of($data['player_id']),
            Monsters::create($data['monsters'][0]),
            Enemies::create($data['enemies'][0])
        );
    }
}
