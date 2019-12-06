<?php
declare(strict_types=1);
namespace Test\Resource\Page;

use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceInterface;
use PHPUnit\Framework\TestCase;
use Wonderland\Domain\Adventure\Model\Gate\GateRepository;

final class GatesTest extends TestCase
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
     * @testdox 保存されているの旅の扉を全て取得出来る
     */
    public function onGet()
    {
        $gates = $this->gateRepository->all();

        $resource = $this->resource->get('page://self/gates');

        $this->assertSame(200, $resource->code);
        $this->assertCount(count($gates), $resource->body['gates']);
    }
}
