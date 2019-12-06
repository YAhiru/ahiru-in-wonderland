<?php
declare(strict_types=1);
namespace Test\Resource;

use App\Resource\OptionsRenderer;
use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use PHPUnit\Framework\TestCase;

final class OptionsRendererTest extends TestCase
{
    private OptionsRenderer $renderer;

    public function setUp() : void
    {
        $this->renderer = (new AppInjector('App', 'app'))->getInstance(OptionsRenderer::class);
    }

    public function test()
    {
        $ro = new class extends ResourceObject {
            public function onGet()
            {
                return $this;
            }

            public function onPatch()
            {
                return $this;
            }
        };
        $this->renderer->render($ro);

        $this->assertSame('http://localhost:3000', $ro->headers[ResponseHeader::ACCESS_CONTROL_ALLOW_ORIGIN]);
        $this->assertSame('Content-Type', $ro->headers['Access-Control-Allow-Headers']);
        $this->assertSame('GET, PATCH', $ro->headers['Access-Control-Allow-Methods']);
    }
}
