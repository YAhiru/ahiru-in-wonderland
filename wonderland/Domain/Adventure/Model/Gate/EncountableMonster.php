<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate;

final class EncountableMonster
{
    /** @var FloorRange */
    private $floorRange;
    /** @var LevelRange */
    private $levelRange;

    public function __construct(FloorRange $floorRange, LevelRange $levelRange)
    {
        $this->floorRange = $floorRange;
        $this->levelRange = $levelRange;
    }
}
