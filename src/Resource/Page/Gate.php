<?php
declare(strict_types=1);
namespace App\Resource\Page;

use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\StatusCode;
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
