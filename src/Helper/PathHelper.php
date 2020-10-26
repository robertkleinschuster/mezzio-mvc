<?php

declare(strict_types=1);

namespace Mvc\Helper;

use Mezzio\Helper\ServerUrlHelper;
use Mezzio\Helper\UrlHelper;
use Mvc\Handler\MvcHandler;

/**
 * Class PathHelper
 * @package Mvc\Helper
 */
class PathHelper
{

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    /**
     * @var ServerUrlHelper
     */
    private $serverUrlHelper;

    /**
     * @var ViewIdHelper
     */
    private $viewIdHelper;

    /**
     * @var array
     */
    private $viewId_Map;

    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $routeName;

    /**
     * Path constructor.
     * @param UrlHelper $urlHelper
     * @param ServerUrlHelper $serverUrlHelper
     * @param ViewIdHelper $viewIdHelper
     */
    public function __construct(UrlHelper $urlHelper, ServerUrlHelper $serverUrlHelper, ViewIdHelper $viewIdHelper)
    {
        $this->urlHelper = $urlHelper;
        $this->viewIdHelper = $viewIdHelper;
        $this->serverUrlHelper = $serverUrlHelper;
    }

    /**
     * @return UrlHelper
     */
    public function getUrlHelper(): UrlHelper
    {
        return $this->urlHelper;
    }

    /**
     * @return ServerUrlHelper
     */
    public function getServerUrlHelper(): ServerUrlHelper
    {
        return $this->serverUrlHelper;
    }

    /**
     * @return ViewIdHelper
     */
    public function getViewIdHelper(): ViewIdHelper
    {
        return $this->viewIdHelper;
    }

    /**
     * @return array
     */
    public function getViewIdMap(): array
    {
        return $this->viewId_Map;
    }

    /**
     * @param array $viewId_Map
     *
     * @return $this
     */
    public function setViewIdMap(array $viewId_Map): self
    {
        $this->viewId_Map = $viewId_Map;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasViewIdMap(): bool
    {
        return $this->viewId_Map !== null;
    }

    /**
     * @param string $key
     * @param null $value
     */
    public function addViewId(string $key, $value = null)
    {
        if (null === $value) {
            $value = "{{$key}}";
        }
        $this->viewId_Map[$key] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     *
     * @return $this
     */
    public function setController(string $controller): self
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasController(): bool
    {
        return $this->controller !== null;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @return $this
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAction(): bool
    {
        return $this->action !== null;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     *
     * @return $this
     */
    public function setParams(array $params): self
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasParams(): bool
    {
        return $this->params !== null;
    }

    /**
     * @param string $key
     * @param $value
     * @return PathHelper
     */
    public function addParam(string $key, $value = null)
    {
        if ($value === null) {
            $value = "{{$key}}";
        }
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getRouteName(): string
    {
        return $this->routeName;
    }

    /**
     * @param string $routeName
     *
     * @return $this
     */
    public function setRouteName(string $routeName): self
    {
        $this->routeName = $routeName;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasRouteName(): bool
    {
        return $this->routeName !== null;
    }

    /**
     * @return $this
     */
    public function reset(): self
    {
        $this->params = null;
        $this->routeName = null;
        $this->controller = null;
        $this->action = null;
        $this->viewId_Map = null;
        return $this;
    }

    /**
     * @param bool $reset
     * @return string
     */
    public function getPath(bool $reset = true): string
    {
        $routeParams = [];
        if ($this->hasAction()) {
            $routeParams[MvcHandler::ACTION_ATTRIBUTE] = $this->getAction();
        }
        if ($this->hasController()) {
            $routeParams[MvcHandler::CONTROLLER_ATTRIBUTE] = $this->getController();
        }
        if ($this->hasParams()) {
            $params = $this->getParams();
        } else {
            $params = [];
        }
        if ($this->hasRouteName()) {
            $routeName = $this->getRouteName();
        } else {
            $routeName = null;
        }
        if ($this->hasViewIdMap()) {
            $params[ViewIdHelper::VIEWID_ATTRIBUTE] = $this->getViewIdHelper()->generateViewId($this->getViewIdMap());
        }
        $path = $this->getUrlHelper()->generate($routeName, $routeParams, $params);
        if ($reset) {
            $this->reset();
        }
        return $path;
    }

    /**
     * @param bool $reset
     * @return string
     */
    public function getServerPath(bool $reset = true): string
    {
        return $this->getServerUrlHelper()->generate($this->getPath($reset));
    }
}
