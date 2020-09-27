<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Controller;

use Mezzio\Helper\UrlHelper;
use Mezzio\Mvc\Handler\MvcHandler;
use Mezzio\Mvc\Handler\ViewIdHelper;
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
     * @var UrlHelper
     */
    private $urlHelper;

    /**
     * @var ViewIdHelper
     *
     */
    private $viewIdHelper;

    /**
     * @var View
     */
    private $view;

    /**
     * AbstractController constructor.
     * @param ControllerRequest $controllerRequest
     * @param ControllerResponse $controllerResponse
     * @param ModelInterface $model
     * @param UrlHelper $urlHelper
     * @param ViewIdHelper $viewIdHelper
     */
    public function __construct(
        ControllerRequest $controllerRequest,
        ControllerResponse $controllerResponse,
        ModelInterface $model,
        UrlHelper $urlHelper,
        ViewIdHelper $viewIdHelper
    ) {
        $this->model = $model;
        $this->controllerRequest = $controllerRequest;
        $this->controllerResponse = $controllerResponse;
        $this->urlHelper = $urlHelper;
        $this->viewIdHelper = $viewIdHelper;
    }


    /**
     *
     */
    public function init()
    {

    }


    public function post()
    {

    }


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
     * @return UrlHelper
     */
    public function getUrlHelper(): UrlHelper
    {
        return $this->urlHelper;
    }


    /**
     * @return ViewIdHelper
     */
    public function getViewIdHelper(): ViewIdHelper
    {
        return $this->viewIdHelper;
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

    /**
     * @param string $controller
     * @param string $action
     * @param array $params
     * @return string|null
     */
    protected function getPath(string $action, ?string $controller = null, ?array $params = null): string
    {
        $routeParams = [];
        $routeParams[MvcHandler::ACTION_ATTRIBUTE] = $action;
        if (null !== $controller) {
            $routeParams[MvcHandler::CONTROLLER_ATTRIBUTE] = $controller;
        }
        return $this->getUrlHelper()->generate(null, $routeParams, $params);
    }
}
