<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Factory;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Helper\Template\TemplateVariableContainer;
use Mezzio\Mvc\Controller\AbstractController;
use Mezzio\Mvc\Controller\ControllerRequest;
use Mezzio\Mvc\Controller\ControllerResponse;
use Mezzio\Mvc\Exception\MvcException;
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
    public function __invoke(string $code, ServerRequestInterface $request)
    {
        /**
         * @var AbstractController $controller
         */
        $controller = $this->container->get($this->getControllerClass($code));
        $controller->setControllerRequest(new ControllerRequest($request));
        $controller->setControllerResponse(new ControllerResponse());
        return $controller;
    }

    /**
     * @param string $code
     * @return string
     * @throws MvcException
     */
    protected function getControllerClass(string $code): string
    {
        if (null === $this->config['controllers'][$code]) {
            throw new MvcException("No controller class found for code '$code'. Check your mvc configuration.");
        }
        return $this->config['controllers'][$code];
    }
}
