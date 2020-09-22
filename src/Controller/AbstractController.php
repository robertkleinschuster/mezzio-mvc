<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Controller;

use Mezzio\Mvc\Model\ModelInterface;
use NiceshopsDev\Bean\BeanException;

abstract class AbstractController implements ControllerInterface
{

    /**
     * @var string
     */
    private $actionSuffix = 'Action';

    /**
     * @var ModelInterface
     */
    private $model;

    /**
     * @var ControllerRequest
     */
    private $requestProperties;

    /**
     * @var ControllerResponse
     */
    private $responseProperties;

    /**
     * @return ControllerRequest
     */
    public function getControllerRequest(): ControllerRequest
    {
        return $this->requestProperties;
    }

    /**
     * @param ControllerRequest $requestProperties
     * @return $this|AbstractController
     */
    public function setControllerRequest(ControllerRequest $requestProperties)
    {
        $this->requestProperties = $requestProperties;
        return $this;
    }

    /**
     * @return ControllerResponse
     */
    public function getControllerResponse(): ControllerResponse
    {
        return $this->responseProperties;
    }

    /**
     * @param ControllerResponse $responseProperties
     * @return $this|AbstractController
     */
    public function setControllerResponse(ControllerResponse $responseProperties)
    {
        $this->responseProperties = $responseProperties;
        return $this;
    }

    /**

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
