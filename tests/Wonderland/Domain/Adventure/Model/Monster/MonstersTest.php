<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Monster;

use PHPUnit\Framework\TestCase;
use Test\Helper\Factory\Adventure\MonsterFactory;
use Wonderland\Domain\Adventure\Model\Monster\Monsters;
use Wonderland\Domain\Model\ConstructException;

final class MonstersTest extends TestCase
{
    /**
     * @testdox 敵の数は最大3匹まで
     */
    public function testCreate1()
    {
        $monsters = MonsterFactory::start()->makeMultiple(4);

        $this->expectException(ConstructException::class);
        Monsters::create(...$monsters);
    }

    /**
     * @testdox 敵がいない状態はダメ
     */
    public function testCreate2()
    {
        $this->expectException(ConstructException::class);
        Monsters::create();
    }
}
