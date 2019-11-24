<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate\Encountable;

use Wonderland\Domain\Adventure\Model\Battle\Enemy;
use Wonderland\Domain\Model\AbstractCollection;

final class EncountableMonsters extends AbstractCollection
{
    /** @var EncountableMonster[] */
    protected $items;

    public static function make(EncountableMonster ...$monsters)
    {
        return new self($monsters);
    }

    public function createEnemy(EncountableMonsterId $id) : Enemy
    {
        $encountable = $this->search($id);
        if ($encountable === null) {
            throw new EncountableMonsterNotFoundException('Encountable monster not found. id: ' . $id->getValue());
        }

        return new Enemy(
            $encountable->getName(),
            $encountable->getLevelRange()->random()
        );
    }

    public function filterTargetFloor(int $targetFloor) : self
    {
        return $this->filter(function (EncountableMonster $monster) use ($targetFloor) {
            return $monster->inFloor($targetFloor);
        });
    }

    /**
     * @return EncountableMonsterId[]
     */
    public function getIds() : array
    {
        return $this->map(function (EncountableMonster $monster) {
            return $monster->getId();
        });
    }

    public function search(EncountableMonsterId $id) : ?EncountableMonster
    {
        foreach ($this->items as $monster) {
            if ($id->equals($monster->getId())) {
                return $monster;
            }
        }

        return null;
    }
}
