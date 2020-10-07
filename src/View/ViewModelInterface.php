<?php

declare(strict_types=1);

namespace Mvc\View;

use Mvc\Bean\TemplateDataBean;
use Mvc\View\Navigation\Navigation;

interface ViewModelInterface
{
    public function getTitle(): string;
    public function setTitle($title);
    public function getTemplateData(): TemplateDataBean;
}
