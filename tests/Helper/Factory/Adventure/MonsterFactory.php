<?php
declare(strict_types=1);
namespace Test\Helper\Factory\Adventure;

use Faker\Generator as Faker;
use Test\Helper\Factory\AbstractFactory;
use Wonderland\Domain\Adventure\Model\Monster\Monster;

/**
 * @method Monster make(array $attributes = [])
 * @method Monster[] makeMultiple(int $times, array $attributes = [])
 * @method Monster store(array $attributes = [])
 * @method Monster[] storeMultiple(int $times, array $attributes = [])
 */
final class MonsterFactory extends AbstractFactory
{
    protected function class() : string
    {
        return Monster::class;
    }

    protected function default(Faker $faker) : array
    {
        return [
            'name' => 'testing monster',
            'level' => $faker->randomDigit,
        ];
    }
}
