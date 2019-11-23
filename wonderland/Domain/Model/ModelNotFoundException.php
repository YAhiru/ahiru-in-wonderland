<?php
declare(strict_types=1);
namespace Wonderland\Domain\Model;

use RuntimeException;

class ModelNotFoundException extends RuntimeException implements WonderlandException
{
    protected $code = 404;
}
