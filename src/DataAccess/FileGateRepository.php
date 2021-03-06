<?php
declare(strict_types=1);
namespace App\DataAccess;

use Wonderland\Domain\Adventure\Model\Gate\Gate;
use Wonderland\Domain\Adventure\Model\Gate\GateId;
use Wonderland\Domain\Adventure\Model\Gate\GateNotFoundException;
use Wonderland\Domain\Adventure\Model\Gate\GateRepository;

/**
 * @codeCoverageIgnore
 */
class FileGateRepository extends AbstractFileRepository implements GateRepository
{
    public function nextId() : GateId
    {
        return GateId::of((string) $this->uuid);
    }

    public function create(Gate $gate) : void
    {
        $data = $this->unserialize();
        $data[$gate->getId()->getValue()] = $gate;
        $this->serialize($data);
    }

    public function update(Gate $gate) : void
    {
        $data = $this->unserialize();
        $data[$gate->getId()->getValue()] = $gate;
        $this->serialize($data);
    }

    public function find(GateId $id) : Gate
    {
        $gate = $this->unserialize()[$id->getValue()];
        if (! $gate) {
            throw new GateNotFoundException('Gate not found. given id: ' . $id->getValue());
        }

        return $gate;
    }

    public function all() : array
    {
        return $this->unserialize() ?: [];
    }
}
