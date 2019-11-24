<?php
declare(strict_types=1);
namespace App\DataAccess;

use Wonderland\Domain\Adventure\Model\Battle\Battle;
use Wonderland\Domain\Adventure\Model\Battle\BattleId;
use Wonderland\Domain\Adventure\Model\Battle\BattleNotFoundException;
use Wonderland\Domain\Adventure\Model\Battle\BattleRepository;

/**
 * @codeCoverageIgnore
 */
class FileBattleRepository extends AbstractFileRepository implements BattleRepository
{
    public function nextId() : BattleId
    {
        return BattleId::of((string) $this->uuid);
    }

    public function create(Battle $battle) : void
    {
        $data = $this->unserialize();
        $data[$battle->getId()->getValue()] = $battle;
        $this->serialize($data);
    }

    public function find(BattleId $id) : Battle
    {
        $gate = $this->unserialize()[$id->getValue()];
        if (! $gate) {
            throw new BattleNotFoundException('Battle not found. given id: ' . $id->getValue());
        }

        return $gate;
    }
}
