<?php
declare(strict_types=1);
namespace Test\Resource\Page;

use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceInterface;
use PHPUnit\Framework\TestCase;
use Test\Helper\Factory\Adventure\GateFactory;
use Wonderland\Domain\Adventure\Model\Gate\GateId;
use Wonderland\Domain\Adventure\Model\Gate\GateRepository;

final class GateTest extends TestCase
{
    /** @var ResourceInterface */
    private $resource;
    /** @var GateRepository */
    private $gateRepository;

    protected function setUp() : void
    {
        $injector = new AppInjector('App', 'app');
        $this->resource = $injector->getInstance(ResourceInterface::class);
        $this->gateRepository = $injector->getInstance(GateRepository::class);
    }

    /**
     * @test
     * @testdox 指定したIDの旅の扉が取得出来る
     */
    public function onGet()
    {
        $gate = GateFactory::start()->make([
            'id' => GateId::of('1'),
        ]);
        $this->gateRepository->create($gate);
        $resource = $this->resource->get('page://self/gate?id=1');

        $this->assertSame(200, $resource->code);
        $this->assertTrue($gate->getId()->equals(GateId::of($resource->body['id'])));
        $this->assertSame($gate->getName(), $resource->body['name']);
        $this->assertIsArray($resource->body['encountableMonsters']);
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
        ]);
        $this->gateRepository->create($gate);

        $resource = $this->resource->patch('page://self/gate', ['id' => '1', 'name' => 'updated name']);

        $this->assertSame(200, $resource->code);

        $updatedGate = $this->gateRepository->find($gate->getId());
        $this->assertSame('updated name', $updatedGate->getName());
    }
}
