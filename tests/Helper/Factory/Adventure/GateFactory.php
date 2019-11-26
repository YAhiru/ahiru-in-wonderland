<?php
declare(strict_types=1);
namespace Test\Helper\Factory\Adventure;

use Faker\Generator as Faker;
use Test\Helper\Factory\AbstractFactory;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonster;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsterId;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsters;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\FloorRange;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\LevelRange;
use Wonderland\Domain\Adventure\Model\Gate\Gate;
use Wonderland\Domain\Adventure\Model\Gate\GateId;

/**
 * @method Gate make(array $attributes = [])
 * @method Gate[] makeMultiple(int $times, array $attributes = [])
 * @method Gate store(array $attributes = [])
 * @method Gate[] storeMultiple(int $times, array $attributes = [])
 */
final class GateFactory extends AbstractFactory
{
    protected function class() : string
    {
        return Gate::class;
    }

    protected function default(Faker $faker) : array
    {
        $topFloor = $faker->numberBetween(1, 25);

        return [
            'id' => GateId::of($faker->uuid),
            'encountableMonsters' => EncountableMonsters::make(
                new EncountableMonster(
                    EncountableMonsterId::of($faker->uuid),
                    $faker->name,
                    FloorRange::create(1, $topFloor),
                    LevelRange::create(1, 10)
                )
            ),
        ];
    }
}
