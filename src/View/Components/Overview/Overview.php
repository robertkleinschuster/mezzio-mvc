<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Overview;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;

class Overview extends AbstractComponent
{

    public function getTemplate(): string
    {
        return 'components/overview/overview';
    }
}
