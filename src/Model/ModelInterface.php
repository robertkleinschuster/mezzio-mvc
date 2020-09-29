<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Model;

use Mezzio\Mvc\Bean\TemplateDataBean;
use Mezzio\Mvc\Helper\ValidationHelper;

interface ModelInterface
{
    public function getTemplateData(): TemplateDataBean;

    public function getValidationHelper(): ValidationHelper;

    public function init(array $ids);

    public function submit(array $attributes);

}
