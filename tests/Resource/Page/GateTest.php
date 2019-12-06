<?php
declare(strict_types=1);
namespace Test\Resource\Page;

use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceInterface;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use PHPUnit\Framework\TestCase;
use Test\Helper\Factory\Adventure\GateFactory;
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
