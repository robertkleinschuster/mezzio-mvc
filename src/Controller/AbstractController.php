<?php

declare(strict_types=1);

namespace Mvc\Controller;

use Mvc\Helper\PathHelper;
use Mvc\Helper\ValidationHelper;
use Mvc\Model\ModelInterface;
use Mvc\View\View;
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
        $this->handleParameter();
        $this->getModel()->find($this->getControllerRequest()->getViewIdMap());
        $this->handleSubmit();
    }

    abstract protected function initView();

    abstract protected function initModel();

    protected function handleParameter()
    {
        if ($this->getControllerRequest()->isAjax()) {
            $this->getControllerResponse()->setMode(ControllerResponse::MODE_JSON);
        }
        if ($this->getControllerRequest()->hasNavId() && $this->getControllerRequest()->hasNavIndex()) {
            $this->handleNavigationState(
                $this->getControllerRequest()->getNavId(),
                $this->getControllerRequest()->getNavIndex()
            );
        }
        if ($this->getControllerRequest()->hasLimit() && $this->getControllerRequest()->hasPage()) {
            $this->getModel()->setLimit(
                $this->getControllerRequest()->getLimit(),
                $this->getControllerRequest()->getPage()
            );
        }
        if ($this->getControllerRequest()->hasSearch()) {
            $this->getModel()->handleSearch($this->getControllerRequest()->getSearch());
        }
    }

    protected function handleSubmit()
    {
        if ($this->getControllerRequest()->hasSubmit()) {
            $path = $this->getPathHelper();
            if ($this->getControllerRequest()->hasViewIdMap()) {
                $path->setViewIdMap($this->getControllerRequest()->getViewIdMap());
            }
            $pathUrl = $path->getPath();

            if ($this->handleSubmitSecurity()) {
                $this->getModel()->submit(
                    $this->getControllerRequest()->getSubmit(),
                    $this->getControllerRequest()->getViewIdMap(),
                    $this->getControllerRequest()->getAttributes()
                );
                if ($this->getModel()->getValidationHelper()->hasError()) {
                    $this->handleValidationError($this->getModel()->getValidationHelper());
                } elseif ($this->getControllerRequest()->hasRedirect()) {
                    $pathUrl = $this->getControllerRequest()->getRedirect();
                }
            }
            $this->getControllerResponse()->setRedirect($pathUrl);
        }
    }

    /**
     * @param $controller
     * @param $action
     */
    public function setActiveNavigation(string $controller, string $action)
    {
        foreach ($this->getView()->getNavigationList() as $item) {
            foreach ($item->getElementList() as $element) {
                if ($element->getLink() === $this->getPathHelper()
                        ->setController($controller)
                        ->setAction($action)
                        ->getPath()) {
                    $element->setActive(true);
                    return;
                }
            }
        }
    }


    /**
     * Handle security checks e.g. csrf token before executing submit in model
     *
     * @return bool
     */
    abstract protected function handleSubmitSecurity(): bool;

    /**
     * Handle validation errors from model after submit
     * e.g. set to flash messanger to display them after redirect
     *
     * @param ValidationHelper $validationHelper
     * @return mixed
     */
    abstract protected function handleValidationError(ValidationHelper $validationHelper);

    /**
     * Persist naviations states in Session
     * @param string $id
     * @param int $index
     * @return mixed
     */
    abstract protected function handleNavigationState(string $id, int $index);


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
