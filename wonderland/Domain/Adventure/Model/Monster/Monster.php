<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Monster;

final class Monster
{
    private $id;
    private $name;
    private $level;
    private $hp;
    private $mp;

    public function __construct($id, $name, $level, HitPoint $hp, MagicPoint $mp)
    {
        $this->id = $id;
        $this->name = $name;
        $this->level = $level;
        $this->hp = $hp;
        $this->mp = $mp;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    public function getHp()
    {
        return $this->hp->getCurrent();
    }

    public function getMp()
    {
        return $this->mp->getCurrent();
    }
}
