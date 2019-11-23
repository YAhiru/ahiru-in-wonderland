<?php
declare(strict_types=1);
namespace Wonderland\Domain\Model;

use DomainException;

class ConstructException extends DomainException implements WonderlandException
{
}
