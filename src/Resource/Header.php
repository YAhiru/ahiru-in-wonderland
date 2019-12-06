<?php
declare(strict_types=1);
namespace App\Resource;

use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Provide\Transfer\HeaderInterface;
use Koriym\HttpConstants\ResponseHeader;

final class Header implements HeaderInterface
{
    private \BEAR\Sunday\Provide\Transfer\Header $header;

    public function __construct(\BEAR\Sunday\Provide\Transfer\Header $header)
    {
        $this->header = $header;
    }

    public function __invoke(ResourceObject $ro, array $server) : array
    {
        $ro->headers[ResponseHeader::ACCESS_CONTROL_ALLOW_ORIGIN] = 'http://localhost:3000';

        return $this->header->__invoke($ro, $server);
    }
}
