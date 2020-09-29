<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Controller;

use Mezzio\Mvc\Helper\PathHelper;
use Mezzio\Mvc\Helper\ValidationHelper;
use Mezzio\Mvc\Model\ModelInterface;
use Mezzio\Mvc\View\View;
use NiceshopsDev\Bean\BeanException;

abstract class AbstractController implements ControllerInterface
{

    /**
     * @var ControllerRequest
     */
    private $controllerRequest;

    /**
     * @var ControllerResponse
     */
    private $controllerResponse;

    /**
     * @var ModelInterface
     */
    private $model;

    /**
     * @var PathHelper
     */
    private $pathHelper;

    /**
     * @var View
     */
    private $view;

    /**
     * AbstractController constructor.
     * @param ControllerRequest $controllerRequest
     * @param ControllerResponse $controllerResponse
     * @param ModelInterface $model
     * @param PathHelper $pathHelper
     */
    public function __construct(
        ControllerRequest $controllerRequest,
        ControllerResponse $controllerResponse,
        ModelInterface $model,
        PathHelper $pathHelper
    ) {
        $this->model = $model;
        $this->controllerRequest = $controllerRequest;
        $this->controllerResponse = $controllerResponse;
        $this->pathHelper = $pathHelper;
    }

    /**
     * @return mixed|void
     * @throws \NiceshopsDev\NiceCore\Exception
     */
    public function init()
    {
        $this->initView();
        $this->initModel();
        if ($this->getControllerRequest()->hasAttribute(ControllerRequest::ATTRIBUTE_CREATE)) {
            $this->getModel()->create($this->getControllerRequest()->getViewIdMap());
        } else {
            $this->getModel()->find($this->getControllerRequest()->getViewIdMap());
        }
        $this->handleSubmit();
    }

    abstract protected function initView();

    abstract protected function initModel();

    protected function handleSubmit()
    {
        if ($this->getControllerRequest()->hasSubmit()) {
            $this->getModel()->submit($this->getControllerRequest()->getAttributes());
            $path = $this->getPathHelper();
            if ($this->getControllerRequest()->hasViewIdMap()) {
                $path->setViewIdMap($this->getControllerRequest()->getViewIdMap());
            }
            $pathUrl = $path->getPath();
            if ($this->getModel()->getValidationHelper()->hasError()) {
                $this->handleValidationError($this->getModel()->getValidationHelper());
            } else {
                if ($this->getControllerRequest()->hasRedirect()) {
                    $pathUrl = $this->getControllerRequest()->getRedirect();
                }
            }
            $this->getControllerResponse()->setRedirect($pathUrl);
        }
    }

    abstract protected function handleValidationError(ValidationHelper $validationHelper);


    /**
     * @return ControllerRequest
     */
    public function getControllerRequest(): ControllerRequest
    {
        return $this->controllerRequest;
    }


    /**
     * @return ControllerResponse
     */
    public function getControllerResponse(): ControllerResponse
    {
        return $this->controllerResponse;
    }

    /**
     * @return PathHelper
     */
    public function getPathHelper(): PathHelper
    {
        return $this->pathHelper->reset();
    }

    /**
     *
     * /**
     * @return ModelInterface
     */
    public function getModel(): ModelInterface
    {
        return $this->model;
    }


    /**
     * @return View
     */
    public function getView(): View
    {
        return $this->view;
    }

    /**
     * @param View $view
     * @return AbstractController
     */
    protected function setView(View $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasView(): bool
    {
        return null !== $this->view;
    }

    /**
     * @param string $key
     * @param $value
     * @return AbstractController
     * @throws BeanException
     */
    protected function setTemplateVariable(string $key, $value)
    {
        $this->getModel()->getTemplateData()->setData($key, $value);
        return $this;
    }
}
