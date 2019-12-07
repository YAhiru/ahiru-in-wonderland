<?php
declare(strict_types=1);
namespace Test\Resource\Page;

use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceInterface;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use PHPUnit\Framework\TestCase;
use Test\Helper\Factory\Adventure\EncountableMonsterFactory;
use Test\Helper\Factory\Adventure\GateFactory;
use Wonderland\Domain\Adventure\Model\Gate\Encountable\EncountableMonsters;
use Wonderland\Domain\Adventure\Model\Gate\GateId;
use Wonderland\Domain\Adventure\Model\Gate\GateRepository;

final class GateTest extends TestCase
{
    private ResourceInterface $resource;
    private GateRepository $gateRepository;

    protected function setUp() : void
    {
        $injector = new AppInjector('App', 'app');
        $this->resource = $injector->getInstance(ResourceInterface::class);
        $this->gateRepository = $injector->getInstance(GateRepository::class);
    }

    /**
     * @test
     * @testdox 旅の扉を作成できる
     */
    public function onPost()
    {
        $resource = $this->resource->post('page://self/gate', [
            'name' => 'testing gate',
            'encountableMonsters' => [
                [
                    'name' => 'monster1',
                    'floorRange' => [
                        'max' => 10,
                        'min' => 4
                    ],
                    'levelRange' => [
                        'max' => 20,
                        'min' => 14
                    ],
                ]
            ]
        ]);

        $this->assertSame(201, $resource->code);

        return $resource;
    }

    /**
     * @test
     * @testdox 指定したIDの旅の扉が取得出来る
     * @depends onPost
     */
    public function onGet(ResourceObject $ro)
    {
        $resource = $this->resource->get('page://self' . $ro->headers[ResponseHeader::LOCATION]);

        $this->assertSame(200, $resource->code);
        $this->assertSame('testing gate', $resource->body['name']);
        $this->assertCount(1, $resource->body['encountableMonsters']);
        $this->assertSame('monster1', $resource->body['encountableMonsters'][0]['name']);
        $this->assertSame(10, $resource->body['encountableMonsters'][0]['floorRange']['max']);
        $this->assertSame(4, $resource->body['encountableMonsters'][0]['floorRange']['min']);
        $this->assertSame(20, $resource->body['encountableMonsters'][0]['levelRange']['max']);
        $this->assertSame(14, $resource->body['encountableMonsters'][0]['levelRange']['min']);
    }

    /**
     * @test
     * @testdox 指定したIDの旅の扉の情報を更新出来る
     */
    public function onPatch()
    {
        $gate = GateFactory::start()->make([
            'id' => GateId::of('1'),
            'name' => 'testing gate',
            'encountableMonsters' => EncountableMonsters::make(...EncountableMonsterFactory::start()->makeMultiple(2))
        ]);
        $this->gateRepository->create($gate);

        $resource = $this->resource->patch('page://self/gate', [
            'id' => '1',
            'name' => 'updated name',
            'encountableMonsters' => [
                [
                    'id' => '1',
                    'name' => 'monster1',
                    'floorRange' => [
                        'max' => 10,
                        'min' => 4
                    ],
                    'levelRange' => [
                        'max' => 20,
                        'min' => 14
                    ],
                ]
            ]
        ]);

        $this->assertSame(200, $resource->code);

        $updatedGate = $this->gateRepository->find($gate->getId());
        $this->assertSame('updated name', $updatedGate->getName());
        $this->assertSame(1, $updatedGate->countEncountableMonsters());
    }
}
