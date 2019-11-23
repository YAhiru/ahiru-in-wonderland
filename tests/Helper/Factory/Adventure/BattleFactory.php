<?php
declare(strict_types=1);
namespace Test\Helper\Factory\Adventure;

use Faker\Generator as Faker;
use Test\Helper\Factory\AbstractFactory;
use Wonderland\Domain\Adventure\Model\Battle\Battle;
use Wonderland\Domain\Adventure\Model\Battle\Enemies;

/**
 * @method Battle make(array $attributes = [])
 * @method Battle[] makeMultiple(int $times, array $attributes = [])
 * @method Battle store(array $attributes = [])
 * @method Battle[] storeMultiple(int $times, array $attributes = [])
 */
final class BattleFactory extends AbstractFactory
{
    protected function class() : string
    {
        return Battle::class;
    }

    protected function default(Faker $faker) : array
    {
        return [
            'battleId' => $faker->uuid,
            'enemies' => Enemies::create(
                MonsterFactory::start()->make()
            )
        ];
    }
}
