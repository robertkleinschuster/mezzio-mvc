<?php

declare(strict_types=1);

namespace Mvc\Model;

use Mvc\Bean\TemplateDataBean;
use Mvc\Controller\ControllerRequest;
use Mvc\Helper\ValidationHelper;

interface ModelInterface
{
    public function getTemplateData(): TemplateDataBean;

    public function getValidationHelper(): ValidationHelper;

    public function init();

    public function setLimit(int $limit, int $page);

    public function find(array $viewIdMap);

    public function submit(ControllerRequest $request);

}
