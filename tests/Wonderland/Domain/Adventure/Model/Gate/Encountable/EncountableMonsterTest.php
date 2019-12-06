<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Gate\Encountable;

use PHPUnit\Framework\TestCase;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonster;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsterId;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\FloorRange;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\LevelRange;

final class EncountableMonsterTest extends TestCase
{
    public function testInFloor()
    {
        $monster = new EncountableMonster(
            EncountableMonsterId::of('monsterId'),
            'monster',
            FloorRange::create(1, 3),
            LevelRange::create(10, 10)
        );

        $this->assertTrue($monster->inFloor(1));
        $this->assertTrue($monster->inFloor(3));
        $this->assertFalse($monster->inFloor(0));
        $this->assertFalse($monster->inFloor(4));
    }
}
