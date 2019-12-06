<?php
declare(strict_types=1);
namespace Wonderland\Domain\Adventure\Model\Monster;

final class MonsterBuilder
{
    private MonsterId $id;
    private string $name;
    private Level $level;
    private HitPoint $hitPoint;
    private MagicPoint $magicPoint;

    /**
     * @param mixed|string|MonsterId $id
     *
     * @return $this
     */
    public function setId($id) : self
    {
        if (! $id instanceof MonsterId) {
            $id = MonsterId::of((string) $id);
        }
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param int|string|Level $level
     *
     * @return $this
     */
    public function setLevel($level) : self
    {
        if (! $level instanceof Level) {
            $level = Level::of((int) $level);
        }
        $this->level = $level;

        return $this;
    }

    /**
     * @param string|int|HitPoint $hitPoint
     * @param string|int|null     $max
     *
     * @return $this
     */
    public function setHitPoint($hitPoint, $max = null) : self
    {
        if (! $hitPoint instanceof HitPoint) {
            $hitPoint = HitPoint::of((int) $hitPoint, (int) $max);
        }
        $this->hitPoint = $hitPoint;

        return $this;
    }

    /**
     * @param string|int|MagicPoint $magicPoint
     * @param string|int|null       $max
     *
     * @return $this
     */
    public function setMagicPoint($magicPoint, $max = null) : self
    {
        if (! $magicPoint instanceof MagicPoint) {
            $magicPoint = MagicPoint::of((int) $magicPoint, (int) $max);
        }

        $this->magicPoint = $magicPoint;

        return $this;
    }

    public function build() : Monster
    {
        return new Monster(
            $this->id,
            $this->name,
            $this->level,
            $this->hitPoint,
            $this->magicPoint
        );
    }

    public static function fromArray(array $data) : Monster
    {
        $builder = new self();

        $builder
            ->setId($data['monster_id'])
            ->setLevel($data['level'])
            ->setName($data['name'])
            ->setHitPoint($data['current_hit_point'], $data['max_hit_point'] ?? null)
            ->setMagicPoint($data['current_magic_point'], $data['max_magic_point'] ?? null);

        return $builder->build();
    }
}
