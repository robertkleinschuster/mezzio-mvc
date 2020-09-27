<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Factory;

use Mezzio\Mvc\Exception\ControllerNotFoundException;
use Mezzio\Mvc\Exception\MvcException;
use Psr\Container\ContainerInterface;

class ModelFactory
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ControllerFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $code
     * @return mixed
     * @throws MvcException
     */
    public function __invoke(string $code)
    {
        return $this->container->get($this->getModelClass($this->container->get('config'), $code));
    }

    /**
     * @param string $code
     * @return string
     * @throws MvcException
     */
    protected function getModelClass(array $config, string $code): string
    {
        if (null === $config['mvc']['models'][$code]) {
            throw new ControllerNotFoundException(
                "No model class found for code '$code'. Check your mvc configuration."
            );
        }
        return $config['mvc']['models'][$code];
    }
}
