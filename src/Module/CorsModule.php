<?php
declare(strict_types=1);
namespace App\Module;

use App\Resource\Header;
use App\Resource\OptionsRenderer;
use BEAR\Resource\RenderInterface;
use BEAR\Sunday\Provide\Transfer\HeaderInterface;
use Ray\Di\AbstractModule;

final class CorsModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(HeaderInterface::class)->to(Header::class);
        $this->bind(\BEAR\Sunday\Provide\Transfer\Header::class);
        $this->bind(RenderInterface::class)->annotatedWith('options')->to(OptionsRenderer::class);
        $this->bind(\BEAR\Resource\OptionsRenderer::class);
    }
}
