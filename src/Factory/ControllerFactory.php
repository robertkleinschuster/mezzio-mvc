<?php

declare(strict_types=1);

namespace Mvc\Factory;

use Mvc\Controller\AbstractController;
use Mvc\Controller\ControllerInterface;
use Mvc\Controller\ControllerRequest;
use Mvc\Controller\ControllerResponse;
use Mvc\Exception\ControllerNotFoundException;
use Mvc\Helper\PathHelper;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class ControllerFactory
{


    private $config;

    private $modelFactory;

    private $pathHelper;

    /**
     * ControllerFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->config = $container->get('config');
        $this->modelFactory = $container->get(ModelFactory::class);
        $this->pathHelper = $container->get(PathHelper::class);
    }

    /**
     * @param string $code
     * @param ServerRequestInterface $request
     * @return ControllerInterface
     * @throws ControllerNotFoundException
     * @throws \NiceshopsDev\NiceCore\Exception
     */
    public function __invoke(string $code, ServerRequestInterface $request): ControllerInterface
    {
        $class = $this->getControllerClass($this->config, $code);
        /**
         * @var AbstractController $controller
         */
        return new $class(
            new ControllerRequest($request),
            new ControllerResponse(),
            ($this->modelFactory)($code),
            $this->pathHelper
        );
    }

    /**
     * @param array $config
     * @param string $code
     * @return string
     * @throws ControllerNotFoundException
     */
    protected function getControllerClass(array $config, string $code): string
    {
        if (null === $config['mvc']['controllers'][$code]) {
            throw new ControllerNotFoundException(
                "No controller class found for code '$code'. Check your mvc configuration."
            );
        }
        return $config['mvc']['controllers'][$code];
    }
}
