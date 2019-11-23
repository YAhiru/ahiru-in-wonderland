<?php
declare(strict_types=1);
namespace Wonderland\Application\UseCase\Battle\Encounter;

use Wonderland\Domain\Adventure\Model\Gate\GateId;
use Wonderland\Domain\Model\Player\Player;

final class Input
{
    /** @var Player */
    private $player;
    /** @var GateId */
    private $gateId;
    /** @var int */
    private $floor;

    public function __construct(Player $player, GateId $gateId, int $floor)
    {
        $this->player = $player;
        $this->gateId = $gateId;
        $this->floor = $floor;
    }

    public function getGateId() : GateId
    {
        return $this->gateId;
    }

    public function getFloor() : int
    {
        return $this->floor;
    }

    public function getPlayer() : Player
    {
        return $this->player;
    }
}
