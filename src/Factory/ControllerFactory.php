<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Factory;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Helper\Template\TemplateVariableContainer;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class ControllerFactory
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
     * @param ServerRequestInterface $request
     * @param HtmlResponse $response
     * @return mixed
     */
    public function __invoke(string $code, ServerRequestInterface $request, HtmlResponse $response)
    {
        $controller = $this->container->get($this->getControllerClass($code));
        $controller->setRequest($request);
        $controller->setResponse($response);
        $controller->setContainer($request->getAttribute(TemplateVariableContainer::class));
        return $controller;
    }

    /**
     * @param string $code
     * @return string
     */
    protected function getControllerClass(string $code) : string
    {
        return $this->config['controllers'][$code];
    }
}
