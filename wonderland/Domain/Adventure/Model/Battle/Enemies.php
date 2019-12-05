<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Battle;

use Wonderland\Domain\Model\AbstractCollection;
use Wonderland\Domain\Model\ConstructException;

final class Enemies extends AbstractCollection
{
    /** @var Enemy[] */
    protected array $items;

    public static function create(Enemy ...$enemies) : self
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
        $enemies = [];
        foreach ($this->items as $enemy) {
            $enemies[] = [
                'level' => $enemy->getLevel()->getValue(),
                'name' => $enemy->getName(),
            ];
        }

        return $enemies;
    }
}
