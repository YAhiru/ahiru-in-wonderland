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
    protected GateRepository $gateRepository;

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
    public function onPost(
        string $name,
        array $encountableMonsters
    ) : ResourceObject {
        $monsters = array_map(function (int $idx, array $monster) {
            return new EncountableMonster(
                EncountableMonsterId::of((string) $idx),
                $monster['name'],
                FloorRange::create($monster['floorRange']['min'], $monster['floorRange']['max']),
                LevelRange::create($monster['levelRange']['min'], $monster['levelRange']['max']),
            );
        }, array_keys($encountableMonsters), $encountableMonsters);

        $gate = new \Wonderland\Domain\Adventure\Model\Gate\Gate(
            $this->gateRepository->nextId(),
            $name,
            EncountableMonsters::make(...$monsters)
        );

        $this->gateRepository->create($gate);

        $this->code = 201;
        $this->headers[ResponseHeader::LOCATION] = '/gate?id=' . $gate->getId()->getValue();

        return $this;
    }

    public function onPatch(
        string $id,
        string $name,
        array $encountableMonsters
    ) : ResourceObject {
        $gate = $this->gateRepository->find(GateId::of($id));

        $monsters = array_map(function ($monster) {
            return new EncountableMonster(
                EncountableMonsterId::of((string) $monster['id']),
                $monster['name'],
                FloorRange::create($monster['floorRange']['min'], $monster['floorRange']['max']),
                LevelRange::create($monster['levelRange']['min'], $monster['levelRange']['max']),
            );
        }, $encountableMonsters);

        $gate->update($name, EncountableMonsters::make(...$monsters));

        $this->gateRepository->update($gate);

        $this->code = StatusCode::OK;

        return $this;
    }
}
