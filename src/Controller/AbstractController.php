<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Controller;

use Mezzio\Mvc\Model\ModelInterface;
use NiceshopsDev\Bean\BeanException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController implements ControllerInterface
{

    private $actionSuffix = 'Action';

    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var ModelInterface
     */
    private $model;

    /**
     * @return ServerRequestInterface
     */
    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }

    /**
     * @param ServerRequestInterface $request
     * @return AbstractController
     */
    public function setRequest(ServerRequestInterface $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     * @return AbstractController
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return ModelInterface
     */
    public function getModel(): ModelInterface
    {
        return $this->model;
    }

    /**
     * @param ModelInterface $model
     * @return AbstractController
     */
    public function setModel(ModelInterface $model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionSuffix(): string
    {
        return $this->actionSuffix;
    }

    /**
     * @param string $actionSuffix
     * @return AbstractController
     */
    public function setActionSuffix(string $actionSuffix)
    {
        $this->actionSuffix = $actionSuffix;
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return AbstractController
     * @throws BeanException
     */
    protected function assign(string $key, $value): self
    {
        $this->getModel()->getTemplateData()->setData($key, $value);
        return $this;
    }
}
