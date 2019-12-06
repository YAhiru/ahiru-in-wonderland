<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Gate\Encountable;

use PHPUnit\Framework\TestCase;
use Test\Helper\Factory\Adventure\EncountableMonsterFactory;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsterId;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsterNotFoundException;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsters;

final class EncountableMonstersTest extends TestCase
{
    public function testFilterTargetFloor()
    {
        $monsters = EncountableMonsters::make(
            EncountableMonsterFactory::start()->floorRange(1, 2)->make(),
            EncountableMonsterFactory::start()->floorRange(2, 3)->make()
        );

        $this->assertSame(1, $monsters->filterTargetFloor(1)->count());
        $this->assertSame(2, $monsters->filterTargetFloor(2)->count());
        $this->assertSame(1, $monsters->filterTargetFloor(3)->count());
        $this->assertSame(0, $monsters->filterTargetFloor(0)->count());
        $this->assertSame(0, $monsters->filterTargetFloor(4)->count());
        $this->assertSame(0, $monsters->filterTargetFloor(-1)->count());
    }

    public function testCreateEnemy()
    {
        $monsters = EncountableMonsters::make(
            EncountableMonsterFactory::start()->id('1')->make([
                'name' => 'testing monster'
            ])
        );

        $id = EncountableMonsterId::of('1');
        $this->assertSame('testing monster', $monsters->createEnemy($id)->getName());

        $this->expectException(EncountableMonsterNotFoundException::class);
        $monsters->createEnemy(EncountableMonsterId::of('does not exists'));
    }
}
