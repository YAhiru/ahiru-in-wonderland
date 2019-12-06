<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Gate\Encountable;

use PHPUnit\Framework\TestCase;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\FloorRange;
use Wonderland\Domain\Model\ConstructException;

final class FloorRangeTest extends TestCase
{
    public function testIsInclude()
    {
        $range = FloorRange::create(1, 3);

        $this->assertTrue($range->isInclude(1));
        $this->assertTrue($range->isInclude(3));
        $this->assertFalse($range->isInclude(4));
        $this->assertFalse($range->isInclude(0));
        $this->assertFalse($range->isInclude(-1));
    }

    public function testCreate()
    {
        $this->assertInstanceOf(FloorRange::class, FloorRange::create(1, 1));

        $this->expectException(ConstructException::class);
        FloorRange::create(3, 1);
    }
}
