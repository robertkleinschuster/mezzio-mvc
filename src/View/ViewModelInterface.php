<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

use Mezzio\Mvc\Bean\TemplateDataBean;
use Mezzio\Mvc\View\Navigation\Navigation;

interface ViewModelInterface
{
    public function getTitle(): string;
    public function setTitle($title);
    public function getTemplateData(): TemplateDataBean;
}
