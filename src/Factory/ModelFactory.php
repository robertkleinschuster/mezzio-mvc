<?php

declare(strict_types=1);

namespace Mvc\Factory;

use Mvc\Exception\ControllerNotFoundException;
use Mvc\Exception\MvcException;
use Psr\Container\ContainerInterface;

class ModelFactory
{

    /**
     * @param string $code
     * @param array $config
     * @return mixed
     * @throws ControllerNotFoundException
     */
    public function __invoke(string $code, array $config)
    {
        $model = $this->getModelClass($config, $code);
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
