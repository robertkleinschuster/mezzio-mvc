<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Detail\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

class Number extends AbstractField
{

    public function getTemplate()
    {
        return 'components/detail/fields/number';
    }
}