<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Battle;

use Wonderland\Domain\Adventure\Model\Monster\Level;
use Wonderland\Domain\Adventure\Model\Monster\Monster;
use Wonderland\Domain\Adventure\Model\Monster\MonsterBuilder;
use Wonderland\Domain\Adventure\Model\Monster\Monsters;
use Wonderland\Domain\Model\Player\PlayerId;

final class BattleBuilder
{
    /** @var BattleId */
    private $battleId;
    /** @var PlayerId */
    private $playerId;
    /** @var Monster[] */
    private $monsters = [];
    /** @var Enemy[] */
    private $enemies = [];

    public function setBattleId($id) : self
    {
        if (! $id instanceof BattleId) {
            $id = BattleId::of((string) $id);
        }
        $this->battleId = $id;

        return $this;
    }

    public function setPlayerId($playerId) : self
    {
        if (! $playerId instanceof PlayerId) {
            $playerId = PlayerId::of((string) $playerId);
        }
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * @param Monster[] $monsters
     *
     * @return $this
     */
    public function setMonsters(array $monsters) : self
    {
        $this->monsters = array_map(function ($monster) {
            return $monster instanceof Monster
                ? $monster
                : MonsterBuilder::fromArray($monster);
        }, $monsters);

        return $this;
    }

    /**
     * @param Enemy[] $enemies
     *
     * @return $this
     */
    public function setEnemies(array $enemies) : self
    {
        $this->enemies = array_map(function ($enemy) {
            return $enemy instanceof Enemy
                ? $enemy
                : new Enemy($enemy['name'], Level::of((int) $enemy['level']));
        }, $enemies);

        return $this;
    }

    public static function fromArray(array $data) : Battle
    {
        $builder = new self();

        $builder
            ->setBattleId($data['battle_id'])
            ->setPlayerId($data['player_id'])
            ->setMonsters($data['monsters'])
            ->setEnemies($data['enemies']);

        return $builder->build();
    }

    public function build() : Battle
    {
        return new Battle(
            $this->battleId,
            $this->playerId,
            Monsters::create(...$this->monsters),
            Enemies::create(...$this->enemies)
        );
    }
}
