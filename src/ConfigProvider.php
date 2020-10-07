<?php

declare(strict_types=1);

namespace Mvc;

use Mvc\Controller\ErrorController;
use Mvc\Factory\ControllerFactory;
use Mvc\Factory\ControllerFactoryFactory;
use Mvc\Factory\ModelFactory;
use Mvc\Factory\ModelFactoryFactory;
use Mvc\Handler\MvcHandler;
use Mvc\Handler\MvcHandlerFactory;
use Mvc\Helper\PathHelper;
use Mvc\Helper\PathHelperFactory;
use Mvc\Model\ErrorModel;

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
        $mvcConfig =  [
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
            'module' => []
        ];
        $mvcConfig['merge'] = function (string $module) use ($mvcConfig): array {
            if (array_key_exists($module, $mvcConfig['module'])) {
                $moduleConfig = $mvcConfig['module'][$module];
                return array_replace_recursive($mvcConfig, $moduleConfig);
            }
            return $mvcConfig;
        };
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
