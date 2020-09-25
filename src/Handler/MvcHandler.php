<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Mvc\Controller\ControllerInterface;
use Mezzio\Mvc\Exception\MvcException;
use Mezzio\Mvc\Factory\ControllerFactory;
use Mezzio\Mvc\Factory\ModelFactory;
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
     * @var ModelFactory
     */
    private $modelFactory;

    /**
     * @var array
     */
    private $config;

    /**
     * MvcHandler constructor.
     * @param TemplateRendererInterface $renderer
     * @param ControllerFactory $controllerFactory
     * @param ModelFactory $modelFactory
     * @param array $config
     */
    public function __construct(
        TemplateRendererInterface $renderer,
        ControllerFactory $controllerFactory,
        ModelFactory $modelFactory,
        array $config = []
    )
    {
        $this->renderer = $renderer;
        $this->controllerFactory = $controllerFactory;
        $this->modelFactory = $modelFactory;
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
        $viewTemplateFolder = $this->config['view']['template_folder'];
        /**
         * @var ControllerInterface|OptionAwareInterface $controller
         */
        $controller = ($this->controllerFactory)(
            $request->getAttribute(self::CONTROLLER_ATTRIBUTE),
            $request
        );
        $model = ($this->modelFactory)($request->getAttribute(self::CONTROLLER_ATTRIBUTE));
        $controller->setModel($model);
        if (!method_exists($controller, $actionCode . $controller->getActionSuffix())) {
            return new HtmlResponse(
                $this->renderer->render("$mvcTemplateFolder::$mvc404Template", []),
                404
            );
        }

        $controller->{$actionCode . $controller->getActionSuffix()}();

        $controllerResponse = $controller->getControllerResponse();
        $templateData = $controller->getModel()->getTemplateData();

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
