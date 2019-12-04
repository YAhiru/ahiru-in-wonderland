<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate;

/**
 * @uses \App\DataAccess\FileGateRepository
 */
interface GateRepository
{
    public function nextId() : GateId;

    public function create(Gate $gate) : void;

    public function update(Gate $gate) : void;

    /**
     * @param GateId $id
     *
     * @throws GateNotFoundException
     *
     * @return Gate
     */
    public function find(GateId $id) : Gate;

    /**
     * @return Gate[]
     */
    public function all() : array;
}
