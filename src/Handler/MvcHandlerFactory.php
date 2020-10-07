<?php

declare(strict_types=1);

namespace Mvc\Handler;

use Mvc\Factory\ControllerFactory;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class MvcHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return MvcHandler
     */
    public function __invoke(ContainerInterface $container): MvcHandler
    {
        return new MvcHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(ControllerFactory::class),
            $container->get('config')
        );
    }
}
