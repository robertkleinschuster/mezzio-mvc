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
            'mvc' => [
                'controllers' => [],
                'models' => [],
                'mvc_template_folder' => 'mvc'
            ],
        ];
    }

    protected function getDependencies()
    {
        return [
            'factories'  => [
                MvcHandler::class => MvcHandlerFactory::class,
                ControllerFactory::class => ControllerFactoryFactory::class,
                ModelFactory::class => ModelFactoryFactory::class,
            ],
        ];
    }
}
