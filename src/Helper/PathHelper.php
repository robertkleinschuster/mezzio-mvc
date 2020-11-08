<?php

declare(strict_types=1);

namespace Pars\Mvc\Helper;

use Mezzio\Helper\ServerUrlHelper;
use Mezzio\Helper\UrlHelper;
use Pars\Mvc\Controller\ControllerRequest;
use Pars\Mvc\Handler\MvcHandler;
use Pars\Mvc\Parameter\AbstractParameter;
use Pars\Mvc\Parameter\IdParameter;

/**
 * Class PathHelper
 * @package Pars\Mvc\Helper
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
     * @var string
     */
    private ?string $controller = null;

    /**
     * @var string
     */
    private ?string $action = null;

    /**
     * @var string
     */
    private ?string $routeName = null;

    /**
     * @var AbstractParameter[]
     */
    private array $parameter_List = [];

    /**
     * @var array
     */
    private array $routeParam_List = [];

    /**
     * Path constructor.
     * @param UrlHelper $urlHelper
     * @param ServerUrlHelper $serverUrlHelper
     */
    public function __construct(
        UrlHelper $urlHelper,
        ServerUrlHelper $serverUrlHelper
    ) {
        $this->urlHelper = $urlHelper;
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
     * @param AbstractParameter $parameter
     * @return PathHelper
     */
    public function addParameter(AbstractParameter $parameter)
    {
        $this->parameter_List[$parameter->getParamterKey()] = $parameter;
        return $this;
    }

    /**
     * @return AbstractParameter[]
     */
    public function getParameterList(): array
    {
        return $this->parameter_List;
    }

    /**
     * @return bool
     */
    public function hasParameterList(): bool
    {
        return count($this->parameter_List) > 0;
    }

    /**
     * @param IdParameter $idParameter
     * @return $this
     */
    public function setId(IdParameter $idParameter)
    {
        if (count($idParameter->getAttribute_List())) {
            $this->addParameter($idParameter);
        }
        return $this;
    }

    /**
     * @return IdParameter
     */
    public function getId(): IdParameter
    {
        if (!$this->hasParameterList() || !isset($this->parameter_List[ControllerRequest::ATTRIBUTE_ID])) {
            $this->parameter_List[ControllerRequest::ATTRIBUTE_ID] = new IdParameter();
        }
        return $this->parameter_List[ControllerRequest::ATTRIBUTE_ID];
    }

    /**
     * @return $this
     */
    public function resetId()
    {
        unset($this->parameter_List[ControllerRequest::ATTRIBUTE_ID]);
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addRouteParameter(string $key, string $value)
    {
        $this->routeParam_List[$key] = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function reset(): self
    {
        $this->routeName = null;
        $this->controller = null;
        $this->action = null;
        $this->routeParam_List = [];
        $this->parameter_List = [];
        return $this;
    }

    /**
     * @param bool $reset
     * @return string
     */
    public function getPath(bool $reset = false): string
    {
        $routeParams = $this->routeParam_List;
        if ($this->hasAction()) {
            $routeParams[MvcHandler::ACTION_ATTRIBUTE] = $this->getAction();
        }
        if ($this->hasController()) {
            $routeParams[MvcHandler::CONTROLLER_ATTRIBUTE] = $this->getController();
        }
        if ($this->hasRouteName()) {
            $routeName = $this->getRouteName();
        } else {
            $routeName = null;
        }
        $params = [];
        if ($this->hasParameterList()) {
            foreach ($this->getParameterList() as $parameter) {
                $value = $parameter->__toString();
                if (strlen(trim($value))) {
                    $params[$parameter->getParamterKey()] = $value;
                }
            }
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
