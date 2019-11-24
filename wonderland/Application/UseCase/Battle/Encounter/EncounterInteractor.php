<?php
declare(strict_types=1);
namespace Wonderland\Application\UseCase\Battle\Encounter;

use Wonderland\Domain\Adventure\Model\Battle\BattleRepository;
use Wonderland\Domain\Adventure\Model\Gate\GateRepository;

final class EncounterInteractor
{
    /** @var BattleRepository */
    private $battleRepository;
    /** @var GateRepository */
    private $gateRepository;

    public function __construct(
        BattleRepository $battleRepository,
        GateRepository $gateRepository
    ) {
        $this->battleRepository = $battleRepository;
        $this->gateRepository = $gateRepository;
    }

    public function run(Input $input) : Output
    {
        $player = $input->getPlayer();
        $battleId = $this->battleRepository->nextId();
        $gate = $this->gateRepository->find($input->getGateId());

        $enemies = $gate->makeEnemies($input->getFloor(), random_int(1, 3));
        $battle = $player->encounter($enemies, $battleId);
        $this->battleRepository->create($battle);

        return new Output($battle->getId());
    }
}
