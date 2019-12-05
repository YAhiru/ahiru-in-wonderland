<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate;

use Wonderland\Domain\Adventure\Model\Battle\Enemies;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EmptyEncountException;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsters;

final class Gate
{
    private GateId $id;
    private EncountableMonsters $encountableMonsters;
    private string $name;

    public function __construct(GateId $id, string $name, EncountableMonsters $encountableMonsters)
    {
        $this->id = $id;
        $this->name = $name;
        $this->encountableMonsters = $encountableMonsters;
    }

    public function getId() : GateId
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function updateName(string $name) : void
    {
        $this->name = $name;
    }

    public function makeEnemies(int $targetFloor, int $count) : Enemies
    {
        $encountables = $this->encountableMonsters->filterTargetFloor($targetFloor);
        if ($encountables->isEmpty()) {
            throw new EmptyEncountException('Monster does not exists in the floor. floor: ' . $targetFloor);
        }

        $ids = $encountables->getIds();
        $enemies = [];
        while ($count--) {
            $enemies[] = $encountables->createEnemy($ids[array_rand($ids)]);
        }

        return Enemies::create(...$enemies);
    }

    /**
     * @deprecated 消すぞ〜〜〜〜
     */
    public function toArray() : array
    {
        return [
            'id' => $this->getId()->getValue(),
            'name' => $this->getName(),
            'encountableMonsters' => $this->encountableMonsters->toArray()
        ];
    }
}
