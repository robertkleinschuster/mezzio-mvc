<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

use Mezzio\Mvc\Bean\TemplateDataBean;

interface ViewModelInterface
{

    public function getTitle();


    public function getMenu();


    public function getFooter();

    public function getTemplateData(): TemplateDataBean;

}
