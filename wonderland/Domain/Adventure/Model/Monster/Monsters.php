<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Monster;

use Wonderland\Domain\Model\AbstractCollection;
use Wonderland\Domain\Model\ConstructException;

final class Monsters extends AbstractCollection
{
    /** @var Monster[] */
    protected $items;

    public static function create(Monster ...$monsters) : self
    {
        $count = count($monsters);
        if ($count > 3 || $count === 0) {
            throw new ConstructException('Monsters must be greater than 1 and smaller than 3. but given ' . $count . ' monsters.');
        }

        return new self($monsters);
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
                'hp' => $monster->getHp(),
                'mp' => $monster->getMp(),
            ];
        }

        return $monsters;
    }
}
