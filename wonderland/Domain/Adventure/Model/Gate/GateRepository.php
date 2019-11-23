<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate;

interface GateRepository
{
    public function create(Gate $gate) : void;

    /**
     * @param GateId $id
     *
     * @throws GateNotFoundException
     *
     * @return Gate
     */
    public function find(GateId $id) : Gate;
}
