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
use Wonderland\Domain\Adventure\Model\Monster\Level;
use Wonderland\Domain\Adventure\Model\Monster\MagicPoint;
use Wonderland\Domain\Adventure\Model\Monster\Monster;
use Wonderland\Domain\Adventure\Model\Monster\MonsterId;
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
        $player = new Player(
            PlayerId::of('1'),
            Monsters::create(
                new Monster(MonsterId::of('1'), 'monster1', Level::of(10), HitPoint::of(100, 100), MagicPoint::of(100, 100))
            )
        );
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
            'id' => $gate->getId()->getValue(),
            'enemies' => $gate->getEnemies()->toArray(),
            'monsters' => $gate->getMonsters()->toArray(),
        ];

        return $this;
    }
}
