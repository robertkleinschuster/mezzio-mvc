<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Edit;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;

class Edit extends AbstractComponent
{
    public function getTemplate(): string
    {
        return 'components/edit/edit';
    }
}
