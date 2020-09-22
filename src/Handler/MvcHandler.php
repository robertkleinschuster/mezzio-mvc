<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Handler;

use Mezzio\Mvc\Controller\ControllerInterface;
use Mezzio\Mvc\Exception\MvcException;
use Mezzio\Mvc\Factory\ControllerFactory;
use Mezzio\Mvc\Factory\ModelFactory;
use Mezzio\Mvc\Factory\ServerResponseFactory;
use NiceshopsDev\NiceCore\Option\OptionAwareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

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
    ) {
        $this->renderer = $renderer;
        $this->controllerFactory = $controllerFactory;
        $this->modelFactory = $modelFactory;
        $this->config = $config;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws MvcException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $controllerCode = $request->getAttribute(self::CONTROLLER_ATTRIBUTE);
        $actionCode = $request->getAttribute(self::ACTION_ATTRIBUTE);

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
                $this->renderer->render($this->config['mvc_template_folder'] . '::error/404', []),
                404
            );
        }

        $controller->{$actionCode . $controller->getActionSuffix()}();

        $controllerResponse = $controller->getControllerResponse();

        $templateData = $controller->getModel()->getTemplateData()->toArray();
        $renderedOutput = $this->renderer->render(
            "{$this->config['mvc_template_folder']}::$controllerCode/$actionCode",
            $templateData
        );
        $controllerResponse->setBody($renderedOutput);

        return (new ServerResponseFactory())($controller->getControllerResponse());
    }
}
