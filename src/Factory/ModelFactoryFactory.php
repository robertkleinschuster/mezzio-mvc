<?php

declare(strict_types=1);

namespace Mvc\Factory;

use Psr\Container\ContainerInterface;

class ModelFactoryFactory
{
    /**
     * @param ContainerInterface $container
     * @return ModelFactory
     */
    public function __invoke(ContainerInterface $container)
    {
        return new ModelFactory($container);
    }
}
