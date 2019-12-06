<?php
declare(strict_types=1);
namespace Test\Helper\Factory\Adventure;

use Faker\Generator as Faker;
use Test\Helper\Factory\AbstractFactory;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonster;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsterId;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\FloorRange;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\LevelRange;

/**
 * @method EncountableMonster make(array $attributes = [])
 * @method EncountableMonster[] makeMultiple(int $times, array $attributes = [])
 * @method EncountableMonster store(array $attributes = [])
 * @method EncountableMonster[] storeMultiple(int $times, array $attributes = [])
 */
final class EncountableMonsterFactory extends AbstractFactory
{
    /**
     * @param string|int|FloorRange $range
     * @param string|int|null       $max
     *
     * @return self
     */
    public function floorRange($range, $max = null) : self
    {
        if (! $range instanceof FloorRange) {
            $range = FloorRange::create((int) $range, (int) $max);
        }
        $this->addRecipe(['floorRange' => $range]);

        return $this;
    }

    /**
     * @param string|EncountableMonsterId $id
     *
     * @return $this
     */
    public function id($id) : self
    {
        if (! $id instanceof EncountableMonsterId) {
            $id = EncountableMonsterId::of((string) $id);
        }
        $this->addRecipe(['id' => $id]);

        return $this;
    }

    protected function class() : string
    {
        return EncountableMonster::class;
    }

    protected function default(Faker $faker) : array
    {
        return [
            'id' => EncountableMonsterId::of($faker->uuid),
            'name' => $faker->name,
            'floorRange' => FloorRange::create(1, 10),
            'levelRange' => LevelRange::create(1, 10)
        ];
    }
}
