<?php

declare(strict_types=1);

namespace Mvc;

use Mvc\Factory\ControllerFactory;
use Mvc\Factory\ControllerFactoryFactory;
use Mvc\Factory\ModelFactory;
use Mvc\Factory\ModelFactoryFactory;
use Mvc\Handler\MvcHandler;
use Mvc\Handler\MvcHandlerFactory;
use Mvc\Helper\PathHelper;
use Mvc\Helper\PathHelperFactory;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            'mvc' => $this->getMvc(),
            'plates' => [
                'extensions' => [
                ]
            ],
        ];
    }

    protected function getMvc()
    {
        $mvcConfig = [
            'error_controller' => 'error',
            'controllers' => [],
            'models' => [],
            'template_folder' => 'mvc',
            'view' => [
                'template_folder' => 'view',
                'default_layout' => 'dashboard'
            ],
            'action' => [
                'prefix' => '',
                'suffix' => 'Action'
            ],
            'module' => [
                // 'routeName' => [] <- same keys as main mvc config, keys will be recursivly replaced
            ]
        ];
        return $mvcConfig;
    }

    protected function getDependencies()
    {
        return [
            'factories' => [
                MvcHandler::class => MvcHandlerFactory::class,
                PathHelper::class => PathHelperFactory::class,
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
