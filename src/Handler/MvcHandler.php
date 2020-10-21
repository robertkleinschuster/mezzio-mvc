<?php

declare(strict_types=1);

namespace Mvc\Handler;

use Exception;
use Laminas\Diactoros\Response;
use Mezzio\Router\RouteResult;
use Mezzio\Template\TemplateRendererInterface;
use Minifier\TinyMinify;
use Mvc\Controller\ControllerInterface;
use Mvc\Controller\ControllerResponse;
use Mvc\Exception\ActionException;
use Mvc\Exception\ActionNotFoundException;
use Mvc\Exception\ControllerException;
use Mvc\Exception\ControllerNotFoundException;
use Mvc\Exception\NotFoundException;
use Mvc\Factory\ControllerFactory;
use Mvc\Factory\ServerResponseFactory;
use Mvc\View\ViewRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class MvcHandler implements RequestHandlerInterface, MiddlewareInterface
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

    function endsWith( $haystack, $needle ) {
        $length = strlen( $needle );
        if( !$length ) {
            return true;
        }
        return substr( $haystack, -$length ) === $needle;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \NiceshopsDev\NiceCore\Exception
     * @throws ControllerNotFoundException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $controllerCode = $request->getAttribute(self::CONTROLLER_ATTRIBUTE) ?? 'index';
        $actionCode = $request->getAttribute(self::ACTION_ATTRIBUTE) ?? 'index';

        $routeResult = $request->getAttribute(RouteResult::class);
        if (
            is_string($routeResult->getMatchedRouteName())
            && isset($this->config['module'][$routeResult->getMatchedRouteName()])
        ) {
            $config = array_replace_recursive(
                $this->config,
                $this->config['module'][$routeResult->getMatchedRouteName()]
            );
        } else {
            $config = $this->config;
        }

        $mvcTemplateFolder = $config['template_folder'];
        $errorController = $config['error_controller'];
        $actionSuffix = $config['action']['suffix'] ?? '';
        $actionPrefix = $config['action']['prefix'] ?? '';
        $viewTemplateFolder = $config['view']['template_folder'];
        $actionMethod = $actionPrefix . $actionCode . $actionSuffix;
        $controller = null;
        try {
            $controller = ($this->controllerFactory)($controllerCode, $request, $config);
            $controller->init();
            $controller->setActiveNavigation($controllerCode, $actionCode);
            if ($controller->isAuthorized()) {
                $this->executeControllerAction($controller, $actionMethod);
            } else {
                $controller->unauthorized();
            }
            $controller->end();
        } catch (NotFoundException $exception) {
            return (new Response\HtmlResponse($exception->getMessage(), 404));
        } catch (Throwable $exception) {
            $controller = $this->getErrorController($controller, $errorController, $request, $config);
            $controller->error($exception);
        }
        if ($controller->getControllerResponse()->hasOption(ControllerResponse::OPTION_RENDER_RESPONSE)) {
            $templateData = $controller->getModel()->getTemplateData();
            if ($controller->hasView()) {
                $viewRenderer = new ViewRenderer($this->renderer, $viewTemplateFolder);
                $view = $controller->getView();
                $view->getTemplateData()->setFromArray($templateData->toArray());
                $renderedOutput = $viewRenderer->render($view);
            } elseif ($controller->hasTemplate()) {
                $renderedOutput = $this->renderer->render(
                    "$mvcTemplateFolder::{$controller->getTemplate()}",
                    $templateData->toArray()
                );
            } else {
                $renderedOutput = $this->renderer->render(
                    "$mvcTemplateFolder::$controllerCode/$actionCode",
                    $templateData->toArray()
                );
            }
            $controller->getControllerResponse()->setBody(TinyMinify::html($renderedOutput));
        }
        return (new ServerResponseFactory())($controller->getControllerResponse());
    }


    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @throws Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $this->handle($request);
        if ($response->getStatusCode() === 404) {
            return $handler->handle($request);
        }
        return $response;
    }

    /**
     * @param $controller
     * @param $errorController
     * @param $request
     * @param $config
     * @return ControllerInterface
     * @throws ControllerNotFoundException
     * @throws \NiceshopsDev\NiceCore\Exception
     */
    private function getErrorController($controller, $errorController, $request, $config)
    {
        if (null === $controller) {
            $controller = ($this->controllerFactory)($errorController, $request, $config);
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
     * @param string $basePath
     * @return string
     */
    public static function getRoute(string $basePath = ''): string
    {
        return $basePath . '[/[{' . self::CONTROLLER_ATTRIBUTE . '}[/[{' . self::ACTION_ATTRIBUTE . '}[/]]]]]';
    }
}
