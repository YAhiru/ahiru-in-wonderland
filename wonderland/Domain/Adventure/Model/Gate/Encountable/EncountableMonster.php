<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate\Encountable;

final class EncountableMonster
{
    private EncountableMonsterId $id;
    private string $name;
    private FloorRange $floorRange;
    private LevelRange $levelRange;

    public function __construct(EncountableMonsterId $id, string $name, FloorRange $floorRange, LevelRange $levelRange)
    {
        $this->id = $id;
        $this->name = $name;
        $this->floorRange = $floorRange;
        $this->levelRange = $levelRange;
    }

    /**
     * @return EncountableMonsterId
     */
    public function getId() : EncountableMonsterId
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function appearedLastFloor() : int
    {
        return $this->getFloorRange()->getMax();
    }

    public function getFloorRange() : FloorRange
    {
        return $this->floorRange;
    }

    public function getLevelRange() : LevelRange
    {
        return $this->levelRange;
    }

    public function inFloor(int $floor) : bool
    {
        return $this->getFloorRange()->isInclude($floor);
    }
}
