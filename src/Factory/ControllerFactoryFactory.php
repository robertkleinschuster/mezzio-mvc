<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Factory;

use Psr\Container\ContainerInterface;

class ControllerFactoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ControllerFactory($container);
    }
}
