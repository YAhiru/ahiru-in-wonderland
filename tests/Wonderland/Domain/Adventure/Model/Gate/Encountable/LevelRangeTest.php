<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Gate\Encountable;

use PHPUnit\Framework\TestCase;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\LevelRange;
use Wonderland\Domain\Model\ConstructException;

final class LevelRangeTest extends TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(LevelRange::class, LevelRange::create(1, 1));

        $this->expectException(ConstructException::class);
        LevelRange::create(3, 1);
    }

    public function testRandom()
    {
        $range = LevelRange::create(1, 3);

        $random = $range->random()->getValue();
        $this->assertTrue($range->getMin() <= $random);
        $this->assertTrue($random <= $range->getMax());
    }
}
