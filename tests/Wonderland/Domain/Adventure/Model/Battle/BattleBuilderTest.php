<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Battle;

use PHPUnit\Framework\TestCase;
use Wonderland\Domain\Adventure\Model\Battle\BattleBuilder;
use Wonderland\Domain\Adventure\Model\Battle\BattleId;
use Wonderland\Domain\Adventure\Model\Battle\Enemy;
use Wonderland\Domain\Adventure\Model\Monster\HitPoint;
use Wonderland\Domain\Adventure\Model\Monster\Level;
use Wonderland\Domain\Adventure\Model\Monster\MagicPoint;
use Wonderland\Domain\Adventure\Model\Monster\Monster;
use Wonderland\Domain\Adventure\Model\Monster\MonsterId;
use Wonderland\Domain\Model\Player\PlayerId;

final class BattleBuilderTest extends TestCase
{
    /**
     * @dataProvider fromArrayDataProvider
     *
     * @param mixed $data
     */
    public function testFromArray($data)
    {
        $battle = BattleBuilder::fromArray($data);
        $this->assertTrue($battle->getId()->equals(BattleId::of('battleId')));
        $this->assertTrue($battle->getPlayerId()->equals(PlayerId::of('playerId')));
        $this->assertSame(1, $battle->getMonsters()->count());
        $this->assertSame(2, $battle->getEnemies()->count());
    }

    public function fromArrayDataProvider()
    {
        yield 'raw values' => [
            [
                'battle_id' => BattleId::of('battleId'),
                'player_id' => PlayerId::of('playerId'),
                'monsters' => [
                    [
                        'monster_id' => 'monsterId',
                        'level' => '1',
                        'name' => 'monster name',
                        'current_hit_point' => '100',
                        'max_hit_point' => '150',
                        'current_magic_point' => 100,
                        'max_magic_point' => 150,
                    ],
                ],
                'enemies' => [
                    [
                        'name' => 'enemy',
                        'level' => 10,
                    ],
                    [
                        'name' => 'enemy2',
                        'level' => 15,
                    ],
                ],
            ],
        ];

        yield 'value objects' => [
            [
                'battle_id' => 'battleId',
                'player_id' => 'playerId',
                'monsters' => [
                    new Monster(
                        MonsterId::of('monsterId'),
                        'monster name',
                        Level::of(1),
                        HitPoint::of(100, 150),
                        MagicPoint::of(100, 150)
                    ),
                ],
                'enemies' => [
                    new Enemy('enemy', Level::of(10)),
                    new Enemy('enemy2', Level::of(15))
                ],
            ],
        ];
    }
}
