<?php

declare(strict_types=1);

namespace Mvc\Controller;

use Mvc\Helper\PathHelper;
use Mvc\Model\ModelInterface;
use Mvc\View\View;
use Throwable;

interface ControllerInterface
{

    /**
     * @return mixed
     */
    public function init();

    /**
     * @return mixed
     */
    public function end();

    /**
     * @param Throwable $exception
     * @return mixed
     */
    public function error(Throwable $exception);

    /**
     * @return mixed
     */
    public function unauthorized();

    /**
     * @return ControllerRequest
     */
    public function getControllerRequest(): ControllerRequest;

    /**
     * @return ControllerResponse
     */
    public function getControllerResponse(): ControllerResponse;

    /**
     * @return PathHelper
     */
    public function getPathHelper(): PathHelper;

    /**
     * @return ModelInterface
     */
    public function getModel(): ModelInterface;

    /**
     * @return View
     */
    public function getView(): View;

    /**
     * @return bool
     */
    public function hasView(): bool;

    /**
     * @return string
     */
    public function getTemplate(): string;

    /**
     * @param string $template
     *
     * @return $this
     */
    public function setTemplate(string $template): self;

    /**
     * @return bool
     */
    public function hasTemplate(): bool;

    /**
     * @return bool
     */
    public function isAuthorized(): bool;

}
