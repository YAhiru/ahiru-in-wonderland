<?php
declare(strict_types=1);
namespace Test\Helper\Factory;

use Faker\Generator as Faker;
use Wonderland\Domain\Adventure\Model\Monster\HitPoint;
use Wonderland\Domain\Adventure\Model\Monster\MagicPoint;
use Wonderland\Domain\Adventure\Model\Monster\Monster;
use Wonderland\Domain\Adventure\Model\Monster\Monsters;
use Wonderland\Domain\Model\Player\Player;
use Wonderland\Domain\Model\Player\PlayerId;

/**
 * @method Player make(array $attributes = [])
 * @method Player[] makeMultiple(int $times, array $attributes = [])
 * @method Player store(array $attributes = [])
 * @method Player[] storeMultiple(int $times, array $attributes = [])
 */
final class PlayerFactory extends AbstractFactory
{
    protected function class() : string
    {
        return Player::class;
    }

    protected function default(Faker $faker) : array
    {
        return [
            'playerId' => PlayerId::of($faker->uuid),
            'monsters' => Monsters::create(
                new Monster($faker->uuid, 'players monster', 10, new HitPoint(100, 100), new MagicPoint(100, 100))
            )
        ];
    }
}
