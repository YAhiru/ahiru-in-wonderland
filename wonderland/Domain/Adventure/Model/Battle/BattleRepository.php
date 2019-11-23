<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Battle;

/**
 * @uses \App\DataAccess\FileBattleRepository
 */
interface BattleRepository
{
    public function nextId() : BattleId;

    public function create(Battle $battle) : void;

    public function find(BattleId $id) : Battle;
}
