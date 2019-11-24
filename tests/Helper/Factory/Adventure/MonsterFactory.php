<?php
declare(strict_types=1);
namespace Test\Helper\Factory\Adventure;

use Faker\Generator as Faker;
use Test\Helper\Factory\AbstractFactory;
use Wonderland\Domain\Adventure\Model\Monster\HitPoint;
use Wonderland\Domain\Adventure\Model\Monster\Level;
use Wonderland\Domain\Adventure\Model\Monster\MagicPoint;
use Wonderland\Domain\Adventure\Model\Monster\Monster;
use Wonderland\Domain\Adventure\Model\Monster\MonsterId;

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
            'id' => MonsterId::of($faker->uuid),
            'name' => 'testing monster',
            'level' => Level::of($faker->numberBetween(1, 99)),
            'hitPoint' => HitPoint::of(100, 100),
            'magicPoint' => MagicPoint::of(100, 100),
        ];
    }
}
