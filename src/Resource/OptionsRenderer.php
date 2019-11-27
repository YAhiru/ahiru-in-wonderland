<?php
declare(strict_types=1);
namespace App\Resource;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;

final class OptionsRenderer implements RenderInterface
{
    /** @var \BEAR\Resource\OptionsRenderer */
    private $renderer;

    public function __construct(\BEAR\Resource\OptionsRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function render(ResourceObject $ro)
    {
        $view = $this->renderer->render($ro);

        $ro->headers[ResponseHeader::ACCESS_CONTROL_ALLOW_ORIGIN] = 'http://localhost:3000';
        $ro->headers['Access-Control-Allow-Headers'] = 'Content-Type';
        $ro->headers['Access-Control-Allow-Methods'] = $ro->headers[ResponseHeader::ALLOW] ?? '';

        return $view;
    }
}
