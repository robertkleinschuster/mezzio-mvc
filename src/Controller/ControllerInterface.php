<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Controller;

use Mezzio\Mvc\Helper\PathHelper;
use Mezzio\Mvc\Model\ModelInterface;
use Mezzio\Mvc\View\View;

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
     * @param \Exception $exception
     * @return mixed
     */
    public function error(\Exception $exception);

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
}
