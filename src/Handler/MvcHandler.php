<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Handler;

use Mezzio\Mvc\Controller\ControllerInterface;
use Mezzio\Mvc\Factory\ControllerFactory;
use Laminas\Diactoros\Stream;
use Mezzio\Mvc\Factory\ModelFactory;
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
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $stream = new Stream('php://temp', 'wb+');
        $response = new HtmlResponse($stream);
        $controllerCode = $request->getAttribute(self::CONTROLLER_ATTRIBUTE);
        $actionCode = $request->getAttribute(self::ACTION_ATTRIBUTE);

        /**
         * @var ControllerInterface $controller
         */
        $controller = ($this->controllerFactory)(
            $request->getAttribute(self::CONTROLLER_ATTRIBUTE),
            $request,
            $response
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


        if ($stream->isWritable()) {
            $stream->write(
                $this->renderer->render(
                    "{$this->config['mvc_template_folder']}::$controllerCode/$actionCode",
                    $controller->getModel()->getTemplateData()->toArray()
                )
            );
        }
        if ($stream->isSeekable()) {
            $stream->rewind();
        }
        return $controller->getResponse();
    }

}
