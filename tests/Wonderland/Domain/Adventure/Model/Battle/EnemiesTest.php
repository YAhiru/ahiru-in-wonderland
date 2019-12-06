<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Battle;

use PHPUnit\Framework\TestCase;
use Wonderland\Domain\Adventure\Model\Battle\Enemies;
use Wonderland\Domain\Adventure\Model\Battle\Enemy;
use Wonderland\Domain\Adventure\Model\Monster\Level;
use Wonderland\Domain\Model\ConstructException;

final class EnemiesTest extends TestCase
{
    /**
     * @testdox 敵の数は最大3匹まで
     */
    public function testCreate1()
    {
        $enemy1 = new Enemy('enemy1', Level::of(10));
        $enemy2 = new Enemy('enemy2', Level::of(10));
        $enemy3 = new Enemy('enemy3', Level::of(10));
        $enemy4 = new Enemy('enemy4', Level::of(10));

        $this->expectException(ConstructException::class);
        Enemies::create($enemy1, $enemy2, $enemy3, $enemy4);
        Enemies::create();
    }

    /**
     * @testdox 敵がいない状態はダメ
     */
    public function testCreate2()
    {
        $this->expectException(ConstructException::class);
        Enemies::create();
    }
}
