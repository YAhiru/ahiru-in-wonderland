<?php
declare(strict_types=1);
namespace App\Resource\App;

use BEAR\Resource\ResourceObject;
use Wonderland\Domain\Adventure\Model\Gate\EncountableMonsters;
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
            new EncountableMonsters(),
            10
        );

        $this->gateRepository->create($gate);

        $this->code = 201;

        return $this;
    }
}
