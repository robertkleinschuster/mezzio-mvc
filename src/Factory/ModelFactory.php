<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Factory;

use Mezzio\Mvc\Exception\ControllerNotFoundException;
use Mezzio\Mvc\Exception\MvcException;
use Psr\Container\ContainerInterface;

class ModelFactory
{
    private $config;

    /**
     * ControllerFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->config = $container->get('config');
    }

    /**
     * @param string $code
     * @return mixed
     * @throws MvcException
     */
    public function __invoke(string $code)
    {
        $model = $this->getModelClass($this->config, $code);
        return new $model();
    }

    /**
     * @param array $config
     * @param string $code
     * @return string
     * @throws ControllerNotFoundException
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
