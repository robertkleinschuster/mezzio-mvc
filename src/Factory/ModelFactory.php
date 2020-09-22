<?php
declare(strict_types=1);


namespace Mezzio\Mvc\Factory;


use Mezzio\Mvc\Exception\MvcException;
use Psr\Container\ContainerInterface;

class ModelFactory
{

    private $container;

    private $config;

    /**
     * ControllerFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->config = $container->get('config')['mvc'];
    }

    /**
     * @param string $code

     * @return mixed
     */
    public function __invoke(string $code)
    {
        $model = $this->container->get($this->getModelClass($code));
        return $model;
    }

    /**
     * @param string $code
     * @return string
     * @throws MvcException
     */
    protected function getModelClass(string $code) : string
    {
        if (null === $this->config['models'][$code]) {
            throw new MvcException("No model class found for code '$code'. Check your mvc configuration.");
        }
        return $this->config['models'][$code];
    }
}
