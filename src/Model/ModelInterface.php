<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Model;

use Mezzio\Mvc\Bean\TemplateDataBean;
use Mezzio\Mvc\Controller\ControllerRequest;
use Mezzio\Mvc\Helper\ValidationHelper;

interface ModelInterface
{
    public function getTemplateData(): TemplateDataBean;

    public function getValidationHelper(): ValidationHelper;

    public function init();

    public function setLimit(int $limit, int $page);

    public function find(array $viewIdMap);

    public function submit(ControllerRequest $request);

}
