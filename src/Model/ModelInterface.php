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

    public function find(array $viewIdMap);

    public function create(array $viewIdMap);

    public function delete(array $viewIdMap);

    public function save(array $attributes);

    public function submit(ControllerRequest $request);

}
