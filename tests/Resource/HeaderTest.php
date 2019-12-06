<?php
declare(strict_types=1);
namespace Test\Resource;

use App\Resource\Header;
use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use PHPUnit\Framework\TestCase;

final class HeaderTest extends TestCase
{
    private Header $header;

    protected function setUp() : void
    {
        $this->header = (new AppInjector('App', 'app'))->getInstance(Header::class);
    }

    public function testInvoke()
    {
        $ro = new class extends ResourceObject {
        };

        $this->header->__invoke($ro, []);
        $this->assertSame('http://localhost:3000', $ro->headers[ResponseHeader::ACCESS_CONTROL_ALLOW_ORIGIN]);
    }
}
