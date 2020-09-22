<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Overview\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

class Link extends AbstractField
{
    public function getTemplate()
    {
        return 'components/overview/fields/link';
    }
}
