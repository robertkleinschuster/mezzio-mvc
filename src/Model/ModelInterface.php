<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Model;

use Mezzio\Mvc\Bean\TemplateDataBean;

interface ModelInterface
{
    public function getTemplateData(): TemplateDataBean;
}
