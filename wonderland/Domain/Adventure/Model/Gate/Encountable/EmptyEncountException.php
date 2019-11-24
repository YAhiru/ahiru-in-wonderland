<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Gate\Encountable;

use Wonderland\Domain\Model\LogicException;
use Wonderland\Domain\Model\WonderlandException;

final class EmptyEncountException extends LogicException implements WonderlandException
{
}
