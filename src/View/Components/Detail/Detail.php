<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Detail;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;

class Detail extends AbstractComponent
{
    public function getTemplate(): string
    {
        return 'components/detail/detail';
    }
}
