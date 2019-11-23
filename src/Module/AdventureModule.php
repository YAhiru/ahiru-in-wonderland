<?php
declare(strict_types=1);
namespace App\Module;

use App\DataAccess\FileBattleRepository;
use App\DataAccess\FileGateRepository;
use Ray\Di\AbstractModule;
use Wonderland\Application\UseCase\Battle\Encounter\EncounterInteractor;
use Wonderland\Domain\Adventure\Model\Battle\BattleRepository;
use Wonderland\Domain\Adventure\Model\Gate\GateRepository;

final class AdventureModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(EncounterInteractor::class);
        $this->bind(BattleRepository::class)->to(FileBattleRepository::class);
        $this->bind(GateRepository::class)->to(FileGateRepository::class);
    }
}
