<?php
declare(strict_types=1);
namespace Wonderland\Domain\Battle\Model\Monster;

final class Abilities
{
    /** @var HitPoint */
    private $hp;
    private $mp;
    private $attack;
    private $defense;
    private $intelligence;
    private $wildness;
    private $agility;

    public function __construct(HitPoint $hp, $mp, $attack, $defense, $intelligence, $wildness, $agility)
    {
        $this->hp = $hp;
        $this->mp = $mp;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->intelligence = $intelligence;
        $this->wildness = $wildness;
        $this->agility = $agility;
    }
}
