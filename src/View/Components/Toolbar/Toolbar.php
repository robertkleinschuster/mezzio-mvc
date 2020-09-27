<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Toolbar;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;

class Toolbar extends AbstractComponent
{
    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'components/toolbar/toolbar';
    }
}
