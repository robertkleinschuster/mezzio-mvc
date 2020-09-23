<?php

declare(strict_types=1);

namespace Mezzio\Mvc;

use Mezzio\Mvc\Factory\ControllerFactory;
use Mezzio\Mvc\Factory\ControllerFactoryFactory;
use Mezzio\Mvc\Factory\ModelFactory;
use Mezzio\Mvc\Factory\ModelFactoryFactory;
use Mezzio\Mvc\Handler\MvcHandler;
use Mezzio\Mvc\Handler\MvcHandlerFactory;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            'mvc' => [
                'controllers' => [],
                'models' => [],
                'template_folder' => 'mvc',
                'template_404' => 'error/404',
                'view' => [
                    'template_folder' => 'view',
                    'default_layout' => 'dashboard'
                ],
            ],
        ];
    }

    protected function getDependencies()
    {
        return [
            'factories' => [
                MvcHandler::class => MvcHandlerFactory::class,
                ControllerFactory::class => ControllerFactoryFactory::class,
                ModelFactory::class => ModelFactoryFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'view' => [__DIR__ . '/../src/View/templates'],
            ],
        ];
    }
}
