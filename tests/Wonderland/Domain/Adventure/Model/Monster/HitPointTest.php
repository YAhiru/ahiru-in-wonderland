<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Monster;

use PHPUnit\Framework\TestCase;
use Wonderland\Domain\Adventure\Model\Monster\HitPoint;
use Wonderland\Domain\Model\ConstructException;

final class HitPointTest extends TestCase
{
    /**
     * @test
     * @dataProvider canConstructDataProvider
     * @testdox インスタンス化出来るパターンのテスト
     */
    public function canConstruct(int $current, int $max)
    {
        $hp = HitPoint::of($current, $max);
        $this->assertSame($current, $hp->getCurrent());
        $this->assertSame($max, $hp->getMax());
    }

    public function canConstructDataProvider() : array
    {
        $cases = [];

        // case1 -------------------------
        $current = 0;
        $max = 100;
        $cases['現在HPが0'] = [$current, $max];

        // case2 -------------------------
        $current = 100;
        $max = 100;
        $cases['現在HPと最大HPが同じ'] = [$current, $max];

        // case3 -------------------------
        $current = 1;
        $max = 1;
        $cases['最大HPが1'] = [$current, $max];

        // case4 -------------------------
        $current = 100;
        $max = 999;
        $cases['最大HPが999'] = [$current, $max];

        return $cases;
    }

    /**
     * @test
     * @dataProvider canNotConstructDataProvider
     * @testdox インスタンス化出来ないパターンのテスト
     */
    public function canNotConstruct(int $current, int $max, string $exceptionMessage)
    {
        $this->expectException(ConstructException::class);
        $this->expectExceptionMessage($exceptionMessage);
        HitPoint::of($current, $max);
    }

    public function canNotConstructDataProvider() : array
    {
        $cases = [];

        // case1 -------------------------
        $current = -1;
        $max = 100;
        $exceptionMessage = '$current must be greater than 0. but given ' . $current;
        $cases['現在HPは0以上の値であること'] = [$current, $max, $exceptionMessage];

        // case2 -------------------------
        $current = 0;
        $max = 0;
        $exceptionMessage = '$max must be greater than 1. but given ' . $max;
        $cases['最大HPは1以上の値であること'] = [$current, $max, $exceptionMessage];

        // case3 -------------------------
        $current = 10;
        $max = 1001;
        $exceptionMessage = 'HitPoint must be less than 1000. but given ' . $max;
        $cases['最大HPは1000未満の値であること'] = [$current, $max, $exceptionMessage];

        // case4 -------------------------
        $current = 101;
        $max = 100;
        $exceptionMessage = '$current must be less than or equal to $max. but given $current=' . $current . ' $max=' . $max;
        $cases['現在HPは最大HP以下であること'] = [$current, $max, $exceptionMessage];

        return $cases;
    }
}
