<?php
declare(strict_types=1);
namespace Test\Helper\Factory\Adventure;

use Faker\Generator as Faker;
use Test\Helper\Factory\AbstractFactory;
use Wonderland\Domain\Adventure\Model\Gate\EncountableMonsters;
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
        return [
            'id' => GateId::of($faker->uuid),
            'encountableMonsters' => new EncountableMonsters(),
            'topFloor' => $faker->randomDigit,
        ];
    }
}
