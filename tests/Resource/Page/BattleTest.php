<?php
declare(strict_types=1);
namespace Test\Resource\Page;

use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceInterface;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use PHPUnit\Framework\TestCase;

final class BattleTest extends TestCase
{
    /**
     * @var ResourceInterface
     */
    private $resource;

    protected function setUp() : void
    {
        $this->resource = (new AppInjector('App', 'app'))->getInstance(ResourceInterface::class);
    }

    /**
     * @test
     * @testdox バトルが作成される。
     */
    public function onPost()
    {
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
