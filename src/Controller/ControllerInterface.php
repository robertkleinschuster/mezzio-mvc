<?php
declare(strict_types=1);


namespace Mezzio\Mvc\Controller;

use Mezzio\Helper\Template\TemplateVariableContainer;
use Mezzio\Mvc\Model\ModelInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ControllerInterface
{

    /**
     * @return string
     */
    public function getActionSuffix(): string;

    /**
     * @param string $actionSuffix
     * @return AbstractController
     */
    public function setActionSuffix(string $actionSuffix);

    /**
     * @return ServerRequestInterface
     */
    public function getRequest(): ServerRequestInterface;

    /**
     * @param ServerRequestInterface $request
     */
    public function setRequest(ServerRequestInterface $request);

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface;

    /**
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response);

    /**
     * @return ModelInterface
     */
    public function getModel(): ModelInterface;

    /**
     * @param ModelInterface $model
     * @return mixed
     */
    public function setModel(ModelInterface $model);

}
