<?php
declare(strict_types=1);
namespace Wonderland\Application\UseCase\Battle\Encounter;

use Wonderland\Domain\Adventure\Model\Battle\BattleId;

final class Output
{
    /** @var BattleId */
    private $battleId;

    public function __construct(BattleId $battleId)
    {
        $this->battleId = $battleId;
    }

    public function getBattleId() : BattleId
    {
        return $this->battleId;
    }

    public function getLocation() : string
    {
        return '/battle?id=' . $this->getBattleId()->getValue();
    }
}
