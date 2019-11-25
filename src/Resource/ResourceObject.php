<?php
declare(strict_types=1);
namespace App\Resource;

use Koriym\HttpConstants\ResponseHeader;

abstract class ResourceObject extends \BEAR\Resource\ResourceObject
{
    /**
     * @return \BEAR\Resource\ResourceObject
     */
    public function onOptions() : \BEAR\Resource\ResourceObject
    {
        $this->headers[ResponseHeader::ACCESS_CONTROL_ALLOW_ORIGIN] = 'http://localhost:3000';
        $this->headers['Access-Control-Allow-Methods'] = 'DELETE, PUT, PATCH';
        $this->headers['Access-Control-Allow-Headers'] = 'Content-Type';

        return $this;
    }
}
