<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Controller;

use Mezzio\Mvc\Model\ModelInterface;

interface ControllerInterface
{

    /**
     * @return ControllerRequest
     */
    public function getControllerRequest(): ControllerRequest;

    /**
     * @param ControllerRequest $requestProperties
     * @return $this
     */
    public function setControllerRequest(ControllerRequest $requestProperties);

    /**
     * @return ControllerResponse
     */
    public function getControllerResponse(): ControllerResponse;

    /**
     * @param ControllerResponse $responseProperties
     * @return $this
     */
    public function setControllerResponse(ControllerResponse $responseProperties);


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
     * @return ModelInterface
     */
    public function getModel(): ModelInterface;

    /**
     * @param ModelInterface $model
     * @return mixed
     */
    public function setModel(ModelInterface $model);
}
