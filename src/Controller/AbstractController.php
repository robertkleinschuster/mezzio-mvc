<?php

declare(strict_types=1);

namespace Pars\Mvc\Controller;

use Pars\Mvc\Helper\PathHelper;
use Pars\Mvc\Helper\ValidationHelper;
use Pars\Mvc\Model\ModelInterface;
use Pars\Mvc\Parameter\PaginationParameter;
use Pars\Mvc\View\View;

/**
 * Class AbstractController
 * @package Pars\Mvc\Controller
 */
abstract class AbstractController implements ControllerInterface
{

    /**
     * @var ControllerRequest
     */
    private ControllerRequest $controllerRequest;

    /**
     * @var ControllerResponse
     */
    private ControllerResponse $controllerResponse;

    /**
     * @var ModelInterface
     */
    private ModelInterface $model;

    /**
     * @var PathHelper
     */
    private PathHelper $pathHelper;

    /**
     * @var View
     */
    private ?View $view = null;

    /**
     * @var string|null
     */
    private ?string $template = null;

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
     */
    public function init()
    {
        $this->initView();
        $this->initModel();
        $this->handleParameter();
        $this->handleSubmit();
    }

    /**
     * @return mixed
     */
    abstract protected function initView();

    /**
     * @return mixed
     */
    abstract protected function initModel();

    /**
     * @throws \Niceshops\Core\Exception\AttributeExistsException
     * @throws \Niceshops\Core\Exception\AttributeLockException
     * @throws \Niceshops\Core\Exception\AttributeNotFoundException
     */
    protected function handleParameter()
    {
        if ($this->getControllerRequest()->isAjax()) {
            $this->getControllerResponse()->setMode(ControllerResponse::MODE_JSON);
        }

        if ($this->getControllerRequest()->hasNav()) {
            $nav = $this->getControllerRequest()->getNav();
            $this->handleNavigationState(
                $nav->getId(),
                $nav->getIndex()
            );
        }

        if ($this->getControllerRequest()->hasSearch()) {
            $this->getModel()->handleSearch($this->getControllerRequest()->getSearch());
        }

        if ($this->getControllerRequest()->hasOrder()) {
            $this->getModel()->handleOrder($this->getControllerRequest()->getOrder());
        }

        if ($this->getControllerRequest()->hasPagingation()) {
            $pagination = $this->getControllerRequest()->getPagination();
            $this->getModel()->handlePagination($pagination);
        } elseif ($this->getDefaultLimit() > 0) {
            $pagination = new PaginationParameter();
            $pagination->setLimit($this->getDefaultLimit())->setPage(0);
            $this->getModel()->handlePagination($pagination);
        }

        if ($this->getControllerRequest()->hasId()) {
            $this->getModel()->handleId($this->getControllerRequest()->getId());
        }

        if ($this->getControllerRequest()->hasMove()) {
            $this->getModel()->handleMove($this->getControllerRequest()->getMove());
        }
    }

    /**
     * @return int
     */
    protected function getDefaultLimit(): int
    {
        return 0;
    }

    /**
     * @throws \Niceshops\Core\Exception\AttributeExistsException
     * @throws \Niceshops\Core\Exception\AttributeLockException
     * @throws \Niceshops\Core\Exception\AttributeNotFoundException
     */
    protected function handleSubmit()
    {
        if ($this->getControllerRequest()->hasSubmit()) {
            $path = $this->getPathHelper();
            if ($this->getControllerRequest()->hasId()) {
                $path->setIdParamter($this->getControllerRequest()->getId());
            }
            $pathUrl = $path->getPath();
            if ($this->handleSubmitSecurity()) {
                $this->getModel()->submit(
                    $this->getControllerRequest()->getSubmit(),
                    $this->getControllerRequest()->getId(),
                    $this->getControllerRequest()->getAttribute_List()
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
     * @param string $id
     * @return int
     */
    abstract protected function getNavigationState(string $id): int;

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
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     *
     * @return $this
     */
    public function setTemplate(string $template): self
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasTemplate(): bool
    {
        return $this->template !== null;
    }


    /**
     * @param string $key
     * @param $value
     * @return AbstractController
     * @throws \Niceshops\Bean\Type\Base\BeanException
     */
    protected function setTemplateVariable(string $key, $value)
    {
        $this->getModel()->getTemplateData()->setData($key, $value);
        return $this;
    }

    /**
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return true;
    }
}
