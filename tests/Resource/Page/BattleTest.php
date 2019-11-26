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

final class BattleTest extends TestCase
{
    /**
     * @var ResourceInterface
     */
    private $resource;
    /** @var GateRepository */
    private $gateRepository;

    protected function setUp() : void
    {
        $injector = (new AppInjector('App', 'app'));
        $this->resource = $injector->getInstance(ResourceInterface::class);
        $this->gateRepository = $injector->getInstance(GateRepository::class);
    }

    /**
     * @test
     * @testdox バトルが作成される。
     */
    public function onPost()
    {
        $gate = GateFactory::start()->make([
            'id' => GateId::of('1'),
        ]);
        $this->gateRepository->create($gate);

        $resource = $this->resource->post('page://self/battle');

        $this->assertSame(201, $resource->code);

        return $resource;
    }

    /**
     * @test
     * @depends onPost
     * @testdox 指定したIDのバトルが取得出来る
     */
    public function onGet(ResourceObject $resource)
    {
        $resource = $this->resource->get('page://self' . $resource->headers[ResponseHeader::LOCATION]);

        $this->assertIsString($resource->body['id']);
        $this->assertIsArray($resource->body['enemies']);
        $this->assertIsArray($resource->body['monsters']);
    }
}
