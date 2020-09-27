<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Factory;

use Mezzio\Helper\UrlHelper;
use Mezzio\Mvc\Controller\AbstractController;
use Mezzio\Mvc\Controller\ControllerInterface;
use Mezzio\Mvc\Controller\ControllerRequest;
use Mezzio\Mvc\Controller\ControllerResponse;
use Mezzio\Mvc\Exception\ControllerNotFoundException;
use Mezzio\Mvc\Helper\PathHelper;
use Mezzio\Mvc\Helper\ViewIdHelper;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class ControllerFactory
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
     * @param ServerRequestInterface $request
     * @return ControllerInterface
     * @throws ControllerNotFoundException
     * @throws \NiceshopsDev\NiceCore\Exception
     */
    public function __invoke(string $code, ServerRequestInterface $request): ControllerInterface
    {
        $config = $this->container->get('config');
        $class = $this->getControllerClass($config, $code);

        /**
         * @var AbstractController $controller
         */
        $controller = new $class(
            new ControllerRequest($request),
            new ControllerResponse(),
            $this->container->get(PathHelper::class)
        );
        return $controller;
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
