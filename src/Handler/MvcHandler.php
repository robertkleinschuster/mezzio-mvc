<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Handler;

use Mezzio\Mvc\Controller\ControllerInterface;
use Mezzio\Mvc\Controller\ControllerResponse;
use Mezzio\Mvc\Exception\ActionException;
use Mezzio\Mvc\Exception\ActionNotFoundException;
use Mezzio\Mvc\Exception\ControllerException;
use Mezzio\Mvc\Exception\ControllerNotFoundException;
use Mezzio\Mvc\Factory\ControllerFactory;
use Mezzio\Mvc\Factory\ServerResponseFactory;
use Mezzio\Mvc\View\ViewRenderer;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MvcHandler implements RequestHandlerInterface
{

    public const CONTROLLER_ATTRIBUTE = 'controller';
    public const ACTION_ATTRIBUTE = 'action';

    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var ControllerFactory
     */
    private $controllerFactory;

    /**
     * @var array
     */
    private $config;

    /**
     * MvcHandler constructor.
     * @param TemplateRendererInterface $renderer
     * @param ControllerFactory $controllerFactory
     * @param array $config
     */
    public function __construct(
        TemplateRendererInterface $renderer,
        ControllerFactory $controllerFactory,
        array $config
    ) {
        $this->renderer = $renderer;
        $this->controllerFactory = $controllerFactory;
        $this->config = $config;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \NiceshopsDev\NiceCore\Exception
     * @throws ControllerNotFoundException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $controllerCode = $request->getAttribute(self::CONTROLLER_ATTRIBUTE);
        $actionCode = $request->getAttribute(self::ACTION_ATTRIBUTE);

        $mvcTemplateFolder = $this->config['mvc']['template_folder'];
        $errorController = $this->config['mvc']['error_controller'];
        $actionSuffix = $this->config['mvc']['action']['suffix'] ?? '';
        $actionPrefix = $this->config['mvc']['action']['prefix'] ?? '';
        $viewTemplateFolder = $this->config['mvc']['view']['template_folder'];
        $actionMethod = $actionPrefix . $actionCode . $actionSuffix;
        try {
            $controller = ($this->controllerFactory)($controllerCode, $request);
            $controller->init();
            $this->executeControllerAction($controller, $actionMethod);
            $controller->end();
            if ($controller->getControllerResponse()->hasOption(ControllerResponse::OPTION_RENDER_RESPONSE)) {
                $templateData = $controller->getModel()->getTemplateData();
                if ($controller->hasView()) {
                    $viewRenderer = new ViewRenderer($this->renderer, $viewTemplateFolder);
                    $view = $controller->getView();
                    $view->getViewModel()->getTemplateData()->setFromArray($templateData->toArray());
                    $renderedOutput = $viewRenderer->render($view);
                } else {
                    $renderedOutput = $this->renderer->render(
                        "$mvcTemplateFolder::$controllerCode/$actionCode",
                        $templateData->toArray()
                    );
                }
                $controller->getControllerResponse()->setBody($renderedOutput);
            }
        } catch (ActionException | ControllerException $exception) {
            $this->getErrorController($controller, $errorController, $request)->error($exception);
        } catch (ActionNotFoundException | ControllerNotFoundException $exception) {
            $controller = $this->getErrorController($controller, $errorController, $request)->error($exception);
            $controller->getControllerResponse()->setStatusCode(ControllerResponse::STATUS_NOT_FOUND);
        } catch (\Exception $exception) {
            $this->getErrorController($controller, $errorController, $request)->error($exception);
        }
        return (new ServerResponseFactory())($controller->getControllerResponse());
    }

    /**
     * @param $controller
     * @param $errorController
     * @param $request
     * @return ControllerInterface
     * @throws ControllerNotFoundException
     * @throws \NiceshopsDev\NiceCore\Exception
     */
    private function getErrorController($controller, $errorController, $request)
    {
        if (null === $controller) {
            $controller = ($this->controllerFactory)($errorController, $request);
        }
        return $controller;
    }

    /**
     * @param ControllerInterface $controller
     * @param string $actionMethod
     * @throws ActionException | ControllerException | ActionNotFoundException
     */
    protected function executeControllerAction(ControllerInterface $controller, string $actionMethod)
    {
        $methodBlacklist = get_class_methods(ControllerInterface::class);
        if (method_exists($controller, $actionMethod) && !in_array($actionMethod, $methodBlacklist)) {
            $controller->{$actionMethod}();
        } else {
            throw new ActionNotFoundException("Controller action $actionMethod not found.");
        }
    }

    /**
     * @return string
     */
    public static function getRoute(): string
    {
        return '/{' . self::CONTROLLER_ATTRIBUTE . '}/{' . self::ACTION_ATTRIBUTE . '}';
    }
}
