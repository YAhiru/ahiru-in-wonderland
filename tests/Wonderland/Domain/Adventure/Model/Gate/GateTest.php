<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Gate;

use PHPUnit\Framework\TestCase;
use Test\Helper\Factory\Adventure\EncountableMonsterFactory;
use Test\Helper\Factory\Adventure\GateFactory;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EmptyEncountException;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsters;
use Wonderland\Domain\Model\ConstructException;

final class GateTest extends TestCase
{
    public function testCanMakeEnemy()
    {
        $monster = EncountableMonsterFactory::start()->floorRange(1, 3)->make([
            'name' => 'enemy1',
        ]);
        $gate = GateFactory::start()->make([
            'topFloor' => 3,
            'encountableMonsters' => EncountableMonsters::make(
                $monster
            )
        ]);

        $enemies = $gate->makeEnemies(1, 2)->toArray();
        $enemy = $enemies[0];
        $this->assertCount(2, $enemies);
        $this->assertSame('enemy1', $enemy['name']);
    }

    /**
     * @test
     */
    public function 該当する階以外の敵モンスターは取得しない()
    {
        $monster = EncountableMonsterFactory::start()->floorRange(1, 3)->make([
            'name' => 'enemy1',
        ]);
        $monster2 = EncountableMonsterFactory::start()->floorRange(4, 6)->make([
            'name' => 'enemy2'
        ]);
        $gate = GateFactory::start()->make([
            'topFloor' => 6,
            'encountableMonsters' => EncountableMonsters::make(
                $monster,
                $monster2
            )
        ]);

        $enemies = $gate->makeEnemies(1, 3)->toArray();
        $this->assertSame('enemy1', $enemies[0]['name']);
        $this->assertSame('enemy1', $enemies[1]['name']);
        $this->assertSame('enemy1', $enemies[2]['name']);
    }

    /**
     * @test
     */
    public function 該当する階のモンスターがいなければ例外()
    {
        $gate = GateFactory::start()->make([
            'encountableMonsters' => EncountableMonsters::make(
                EncountableMonsterFactory::start()->floorRange(1, 3)->make()
            )
        ]);

        $this->expectException(EmptyEncountException::class);
        $gate->makeEnemies(100, 1);
    }

    /**
     * @test
     */
    public function エンカウント出来るモンスターは1〜3匹まで()
    {
        $gate = GateFactory::start()->make([
            'encountableMonsters' => EncountableMonsters::make(
                EncountableMonsterFactory::start()->floorRange(1, 3)->make()
            )
        ]);

        $this->expectException(ConstructException::class);
        $this->expectExceptionMessage('Enemies must be greater than 1 and smaller than 3. but given 4 enemies.');
        $gate->makeEnemies(1, 4);

        $this->expectException(ConstructException::class);
        $this->expectExceptionMessage('Enemies must be greater than 1 and smaller than 3. but given 0 enemies.');
        $gate->makeEnemies(1, 0);
    }
}
