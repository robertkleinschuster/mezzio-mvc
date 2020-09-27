<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Controller;

use Mezzio\Helper\UrlHelper;
use Mezzio\Mvc\Handler\ViewIdHelper;
use Mezzio\Mvc\Model\ModelInterface;
use Mezzio\Mvc\View\View;

interface ControllerInterface
{
    public function init();

    public function post();

    /**
     * @return ControllerRequest
     */
    public function getControllerRequest(): ControllerRequest;

    /**
     * @return ControllerResponse
     */
    public function getControllerResponse(): ControllerResponse;

    /**
     * @return UrlHelper
     */
    public function getUrlHelper(): UrlHelper;

    /**
     * @return ViewIdHelper
     */
    public function getViewIdHelper(): ViewIdHelper;


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
}
