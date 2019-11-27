<?php
declare(strict_types=1);
namespace App\Module;

use App\Resource\OptionsRenderer;
use BEAR\Resource\RenderInterface;
use Ray\Di\AbstractModule;

final class CorsModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(RenderInterface::class)->annotatedWith('options')->to(OptionsRenderer::class);
        $this->bind(\BEAR\Resource\OptionsRenderer::class);
    }
}
