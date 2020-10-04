<?php

declare(strict_types=1);

namespace Mezzio\Mvc;

use Mezzio\Mvc\Controller\ErrorController;
use Mezzio\Mvc\Factory\ControllerFactory;
use Mezzio\Mvc\Factory\ControllerFactoryFactory;
use Mezzio\Mvc\Factory\ModelFactory;
use Mezzio\Mvc\Factory\ModelFactoryFactory;
use Mezzio\Mvc\Handler\MvcHandler;
use Mezzio\Mvc\Handler\MvcHandlerFactory;
use Mezzio\Mvc\Helper\PathHelper;
use Mezzio\Mvc\Helper\PathHelperFactory;
use Mezzio\Mvc\Model\ErrorModel;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            'mvc' => [
                'error_controller' => 'error',
                'controllers' => [
                    'error' => ErrorController::class
                ],
                'models' => [
                    'error' => ErrorModel::class
                ],
                'template_folder' => 'mvc',
                'view' => [
                    'template_folder' => 'view',
                    'default_layout' => 'dashboard'
                ],
                'action' => [
                    'prefix' => '',
                    'suffix' => 'Action'
                ],
            ],
            'plates' => [
                'extensions' => [

                ]
            ],
        ];
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
