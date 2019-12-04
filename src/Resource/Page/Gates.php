<?php
declare(strict_types=1);
namespace App\Resource\Page;

use BEAR\Resource\ResourceObject;
use Wonderland\Domain\Adventure\Model\Gate\GateRepository;

class Gates extends ResourceObject
{
    /** @var GateRepository */
    protected $gateRepository;

    public function __construct(GateRepository $gateRepository)
    {
        $this->gateRepository = $gateRepository;
    }

    public function onGet() : ResourceObject
    {
        $gates = $this->gateRepository->all();

        $this->code = 200;
        foreach ($gates as $gate) {
            $this->body['gates'][] = $gate->toArray();
        }

        return $this;
    }
}
