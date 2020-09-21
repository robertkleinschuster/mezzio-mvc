<?php
declare(strict_types=1);


namespace Mezzio\Mvc\Factory;


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
     */
    protected function getModelClass(string $code) : string
    {
        return $this->config['models'][$code];
    }
}
