<?php
declare(strict_types=1);
namespace Wonderland\Domain\Model;

class ModelNotFoundException extends RuntimeException
{
    protected $code = 404;
}
