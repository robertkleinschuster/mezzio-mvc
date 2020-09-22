<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

interface ViewModelInterface
{

    public function getTitle();


    public function getMenu();


    public function getFooter();
}
