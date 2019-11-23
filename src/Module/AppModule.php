<?php
namespace App\Module;

use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use Ray\IdentityValueModule\IdentityValueModule;

class AppModule extends AbstractAppModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $appDir = $this->appMeta->appDir;
        require_once $appDir . '/env.php';
        $this->install(new PackageModule);
        $this->install(new IdentityValueModule());
        $this->install(new AdventureModule());
    }
}
