<?php
declare(strict_types=1);
namespace Test\Helper\Factory;

abstract class AbstractFactory extends \Yahiru\EntityFactory\AbstractFactory
{
    public function makeMultiple(int $times, array $attributes = []) : array
    {
        return $this->times($times)->make($attributes);
    }

    public function storeMultiple(int $times, array $attributes = []) : array
    {
        return $this->times($times)->store($attributes);
    }
}
