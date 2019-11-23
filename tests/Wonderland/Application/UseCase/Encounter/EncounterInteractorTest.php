<?php
declare(strict_types=1);
namespace Test\Wonderland\Application\UseCase\Encounter;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Test\Helper\Factory\Adventure\GateFactory;
use Test\Helper\Factory\PlayerFactory;
use Wonderland\Application\UseCase\Battle\Encounter\EncounterInteractor;
use Wonderland\Application\UseCase\Battle\Encounter\Input;
use Wonderland\Domain\Adventure\Model\Battle\BattleId;
use Wonderland\Domain\Adventure\Model\Battle\BattleRepository;
use Wonderland\Domain\Adventure\Model\Gate\GateId;
use Wonderland\Domain\Adventure\Model\Gate\GateRepository;

final class EncounterInteractorTest extends TestCase
{
    /** @var BattleRepository&MockObject */
    private $battleRepo;
    /** @var GateRepository&MockObject */
    private $gateRepo;

    protected function setUp() : void
    {
        $this->battleRepo = $this->createMock(BattleRepository::class);
        $this->gateRepo = $this->createMock(GateRepository::class);
    }

    public function testCanCreateBattle()
    {
        $battleId = BattleId::of('1');
        $gateId = GateId::of('1');
        $gate = GateFactory::start()->make();
        $player = PlayerFactory::start()->make();

        $this->battleRepo->expects($this->once())->method('nextId')->willReturn($battleId);
        $this->battleRepo->expects($this->once())->method('create');
        $this->gateRepo->expects($this->once())->method('find')->with($gateId)->willReturn($gate);

        $useCase = new EncounterInteractor($this->battleRepo, $this->gateRepo);
        $output = $useCase->run(new Input($player, $gateId, 1));

        $this->assertSame($battleId, $output->getBattleId());
    }
}
