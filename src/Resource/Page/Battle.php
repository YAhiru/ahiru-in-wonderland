<?php
declare(strict_types=1);
namespace App\Resource\Page;

use BEAR\Package\Annotation\ReturnCreatedResource;
use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use Wonderland\Application\UseCase\Battle\Encounter\EncounterInteractor;
use Wonderland\Application\UseCase\Battle\Encounter\Input;
use Wonderland\Domain\Adventure\Model\Battle\BattleId;
use Wonderland\Domain\Adventure\Model\Battle\BattleRepository;
use Wonderland\Domain\Adventure\Model\Gate\GateId;
use Wonderland\Domain\Adventure\Model\Monster\HitPoint;
use Wonderland\Domain\Adventure\Model\Monster\MagicPoint;
use Wonderland\Domain\Adventure\Model\Monster\Monster;
use Wonderland\Domain\Adventure\Model\Monster\Monsters;
use Wonderland\Domain\Model\Player\Player;
use Wonderland\Domain\Model\Player\PlayerId;

/**
 * @Cacheable
 */
class Battle extends ResourceObject
{
    /** @var EncounterInteractor */
    protected $postUseCase;
    /** @var BattleRepository */
    protected $battleRepository;

    public function __construct(EncounterInteractor $postUseCase, BattleRepository $battleRepository)
    {
        $this->postUseCase = $postUseCase;
        $this->battleRepository = $battleRepository;
    }

    /**
     * TODO: WIP
     *
     * @ReturnCreatedResource
     *
     * @return ResourceObject
     */
    public function onPost() : ResourceObject
    {
        $player = new Player(PlayerId::of('1'), Monsters::create(new Monster('1', 'monster1', 10, new HitPoint(100, 100), new MagicPoint(100, 100))));
        $input = new Input($player, GateId::of('1'), 1);
        $output = $this->postUseCase->run($input);

        $this->code = StatusCode::CREATED;
        $this->headers[ResponseHeader::LOCATION] = $output->getLocation();

        return $this;
    }

    public function onGet(string $id) : ResourceObject
    {
        $gate = $this->battleRepository->find(BattleId::of($id));

        $this->body = [
            'battleId' => $gate->getBattleId()->value(),
            'enemies' => $gate->getEnemies()->toArray(),
            'yours' => $gate->getMonsters()->toArray(),
        ];

        return $this;
    }
}
