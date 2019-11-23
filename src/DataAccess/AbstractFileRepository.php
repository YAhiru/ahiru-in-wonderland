<?php
declare(strict_types=1);
namespace App\DataAccess;

use BEAR\AppMeta\AbstractAppMeta;
use Ray\IdentityValueModule\UuidInterface;

abstract class AbstractFileRepository
{
    /** @var string */
    protected $storePath;
    /** @var UuidInterface */
    protected $uuid;

    public function __construct(
        AbstractAppMeta $appMeta,
        UuidInterface $uuid
    ) {
        $this->storePath = $appMeta->appDir . '/var/tmp/repository/' . str_replace('\\', '_', get_called_class());
        $this->uuid = $uuid;

        if (! file_exists($this->storePath)) {
            $this->initialize();
        }
    }

    public function clear() : void
    {
        unlink($this->storePath);
        $this->initialize();
    }

    protected function unserialize() : array
    {
        $serialized = file_get_contents($this->storePath);
        if ($serialized === false) {
            throw new \RuntimeException('failed file_get_contents. ' . $this->storePath);
        }

        $data = unserialize($serialized);
        if (is_array($data)) {
            return $data;
        }

        return [];
    }

    protected function initialize()
    {
        $dir = dirname($this->storePath);
        if (! file_exists($dir) && ! mkdir($dir, 0755, true)) {
            throw new \RuntimeException('Failed to create a directory at ' . $dir);
        }
        $this->serialize([]);
    }

    protected function serialize(array $data) : void
    {
        file_put_contents($this->storePath, serialize($data));
    }
}
