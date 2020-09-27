<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Factory;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Mvc\Controller\AbstractController;
use Mezzio\Mvc\Controller\ControllerRequest;
use Mezzio\Mvc\Controller\ControllerResponse;
use Mezzio\Mvc\Exception\MvcException;
use Mezzio\Mvc\Handler\ViewIdHelper;
use Mezzio\Router\RouteResult;
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
     * @return AbstractController
     * @throws MvcException
     * @throws \NiceshopsDev\NiceCore\Exception
     */
    public function __invoke(string $code, ServerRequestInterface $request)
    {
        $config = $this->container->get('config');
        $urlHelper = $this->container->get(UrlHelper::class);
        $class = $this->getControllerClass($config, $code);

        /**
         * @var AbstractController $controller
         */
        $controller = new $class(
            new ControllerRequest($request),
            new ControllerResponse(),
            $urlHelper,
            new ViewIdHelper()
        );
        return $controller;
    }

    /**
     * @param array $config
     * @param string $code
     * @return string
     * @throws MvcException
     */
    protected function getControllerClass(array $config, string $code): string
    {
        if (null === $config['mvc']['controllers'][$code]) {
            throw new MvcException("No controller class found for code '$code'. Check your mvc configuration.");
        }
        return $config['mvc']['controllers'][$code];
    }
}
