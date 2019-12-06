<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Monster;

use PHPUnit\Framework\TestCase;
use Wonderland\Domain\Adventure\Model\Monster\Level;
use Wonderland\Domain\Model\ConstructException;

final class LevelTest extends TestCase
{
    public function testOf()
    {
        $this->expectException(ConstructException::class);
        $this->expectExceptionMessage('Level must be positive number. but given -1');
        Level::of(-1);
    }

    public function testOf2()
    {
        $this->expectException(ConstructException::class);
        $this->expectExceptionMessage('Level must be smaller than 100. but given 100');
        Level::of(100);
    }
}
