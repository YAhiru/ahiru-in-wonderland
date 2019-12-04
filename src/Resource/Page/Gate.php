<?php
declare(strict_types=1);
namespace App\Resource\Page;

use BEAR\Package\Annotation\ReturnCreatedResource;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
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

    public function onGet(string $id) : ResourceObject
    {
        $gate = $this->gateRepository->find(GateId::of($id));

        $this->code = 200;
        $this->body = $gate->toArray();

        return $this;
    }

    /**
     * @ReturnCreatedResource
     */
    public function onPost(string $name)
    {
        $gate = new \Wonderland\Domain\Adventure\Model\Gate\Gate(
            $this->gateRepository->nextId(),
            $name,
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
        $this->headers[ResponseHeader::LOCATION] = '/gate?id=' . $gate->getId()->getValue();

        return $this;
    }

    public function onPatch(
        string $id,
        string $name
    ) : ResourceObject {
        $gate = $this->gateRepository->find(GateId::of($id));

        $gate->updateName($name);

        $this->gateRepository->update($gate);

        $this->code = StatusCode::OK;

        return $this;
    }
}
