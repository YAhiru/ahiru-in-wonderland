<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Battle;

use Wonderland\Domain\Adventure\Model\Monster\Monster;
use Wonderland\Domain\Model\AbstractCollection;
use Wonderland\Domain\Model\ConstructException;

final class Enemies extends AbstractCollection
{
    /** @var Monster[] */
    protected $items;

    public static function create(Monster ...$enemies) : self
    {
        $count = count($enemies);
        if ($count > 3 || $count === 0) {
            throw new ConstructException('Enemies must be greater than 1 and smaller than 3. but given ' . $count . ' enemies.');
        }

        return new self($enemies);
    }

    /**
     * @deprecated QueryServiceを実装したら消すぞ
     */
    public function toArray() : array
    {
        $monsters = [];
        foreach ($this->items as $monster) {
            $monsters[] = [
                'id' => $monster->getId(),
                'level' => $monster->getLevel(),
                'name' => $monster->getName(),
            ];
        }

        return $monsters;
    }
}
