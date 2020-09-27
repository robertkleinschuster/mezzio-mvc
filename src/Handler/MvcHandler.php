<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Mvc\Controller\ControllerInterface;
use Mezzio\Mvc\Controller\ControllerResponse;
use Mezzio\Mvc\Exception\MvcException;
use Mezzio\Mvc\Factory\ControllerFactory;
use Mezzio\Mvc\Factory\ServerResponseFactory;
use Mezzio\Mvc\View\ViewRenderer;
use Mezzio\Template\TemplateRendererInterface;
use NiceshopsDev\Bean\BeanException;
use NiceshopsDev\NiceCore\Option\OptionAwareInterface;
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
     * @throws MvcException
     * @throws BeanException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $controllerCode = $request->getAttribute(self::CONTROLLER_ATTRIBUTE);
        $actionCode = $request->getAttribute(self::ACTION_ATTRIBUTE);

        $mvcTemplateFolder = $this->config['mvc']['template_folder'];
        $mvc404Template = $this->config['mvc']['template_404'];
        $actionSuffix = $this->config['mvc']['action']['suffix'] ?? '';
        $actionPrefix = $this->config['mvc']['action']['prefix'] ?? '';
        $viewTemplateFolder = $this->config['mvc']['view']['template_folder'];
        $actionMethod = $actionPrefix . $actionCode . $actionSuffix;

        /**
         * @var ControllerInterface|OptionAwareInterface $controller
         */
        $controller = ($this->controllerFactory)($controllerCode, $request);

        if (!method_exists($controller, $actionMethod)) {
            return new HtmlResponse(
                $this->renderer->render("$mvcTemplateFolder::$mvc404Template", []),
                404
            );
        }

        $controller->init();

        $controller->{$actionMethod}();

        $controller->post();

        $controllerResponse = $controller->getControllerResponse();
        $templateData = $controller->getModel()->getTemplateData();

        if ($controllerResponse->hasOption(ControllerResponse::OPTION_RENDER_RESPONSE)) {
            if ($controller->hasView()) {
                $viewRenderer = new ViewRenderer($this->renderer, $viewTemplateFolder);
                $view = $controller->getView();
                $templateData->setFromArray($view->getViewModel()->getTemplateData()->toArray());
                $view->getViewModel()->getTemplateData()->setFromArray($templateData->toArray());
                $renderedOutput = $viewRenderer->render($view);
            } else {
                $renderedOutput = $this->renderer->render(
                    "$mvcTemplateFolder::$controllerCode/$actionCode",
                    $templateData->toArray()
                );
            }
            $controllerResponse->setBody($renderedOutput);
        }


        return (new ServerResponseFactory())($controller->getControllerResponse());
    }

    /**
     * @return string
     */
    public static function getRoute(): string
    {
        return '/{' . self::CONTROLLER_ATTRIBUTE . '}/{' . self::ACTION_ATTRIBUTE . '}';
    }
}
