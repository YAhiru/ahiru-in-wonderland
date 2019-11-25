<?php
declare(strict_types=1);
namespace App\Resource\App;

use BEAR\Resource\ResourceObject;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonster;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsterId;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsters;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\FloorRange;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\LevelRange;
use Wonderland\Domain\Adventure\Model\Gate\GateId;
use Wonderland\Domain\Adventure\Model\Gate\GateRepository;

class Gate extends ResourceObject
{
    /** @var GateRepository */
    protected $gateRepository;

    public function __construct(GateRepository $gateRepository)
    {
        $this->gateRepository = $gateRepository;
    }

    /**
     * TODO: WIP
     */
    public function onPost()
    {
        $gate = new \Wonderland\Domain\Adventure\Model\Gate\Gate(
            GateId::of('1'),
            'gate1',
            EncountableMonsters::make(
                new EncountableMonster(
                    EncountableMonsterId::of('1'),
                    'enemy1',
                    FloorRange::create(1, 10),
                    LevelRange::create(5, 8)
                ),
                new EncountableMonster(
                    EncountableMonsterId::of('2'),
                    'enemy2',
                    FloorRange::create(1, 10),
                    LevelRange::create(5, 8)
                ),
                new EncountableMonster(
                    EncountableMonsterId::of('3'),
                    'enemy3',
                    FloorRange::create(1, 10),
                    LevelRange::create(5, 8)
                )
            )
        );

        $this->gateRepository->create($gate);

        $this->code = 201;

        return $this;
    }
}
