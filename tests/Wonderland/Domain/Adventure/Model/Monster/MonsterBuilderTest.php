<?php
declare(strict_types=1);
namespace Test\Wonderland\Domain\Adventure\Model\Monster;

use PHPUnit\Framework\TestCase;
use Wonderland\Domain\Adventure\Model\Monster\HitPoint;
use Wonderland\Domain\Adventure\Model\Monster\Level;
use Wonderland\Domain\Adventure\Model\Monster\MagicPoint;
use Wonderland\Domain\Adventure\Model\Monster\MonsterBuilder;
use Wonderland\Domain\Adventure\Model\Monster\MonsterId;

final class MonsterBuilderTest extends TestCase
{
    /**
     * @dataProvider fromArrayDataProvider
     *
     * @param mixed $data
     */
    public function testFromArray($data)
    {
        $monster = MonsterBuilder::fromArray($data);
        $this->assertTrue($monster->getId()->equals(MonsterId::of('1111')));
        $this->assertSame('monster name', $monster->getName());
        $this->assertSame(1, $monster->getLevel()->getValue());
        $this->assertSame(100, $monster->getCurrentHitPoint());
        $this->assertSame(200, $monster->getCurrentMagicPoint());
    }

    public function fromArrayDataProvider()
    {
        yield 'raw values' => [
            [
                'monster_id' => 1111,
                'level' => '1',
                'name' => 'monster name',
                'current_hit_point' => '100',
                'max_hit_point' => '150',
                'current_magic_point' => '200',
                'max_magic_point' => '250',
            ],
        ];

        yield 'value objects' => [
            [
                'monster_id' => MonsterId::of('1111'),
                'level' => Level::of(1),
                'name' => 'monster name',
                'current_hit_point' => HitPoint::of(100, 150),
                'current_magic_point' => MagicPoint::of(200, 250),
            ],
        ];
    }
}
