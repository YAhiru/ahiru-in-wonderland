<?php
declare(strict_types=1);
namespace App\Interceptor;

use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;

/**
 * @Annotation
 */
class CORS implements MethodInterceptor
{
    public function invoke(MethodInvocation $invocation)
    {
        /** @var ResourceObject $resource */
        $resource = $invocation->proceed();
        $resource->headers[ResponseHeader::ACCESS_CONTROL_ALLOW_ORIGIN] = 'http://localhost:3000';

        return $resource;
    }
}
