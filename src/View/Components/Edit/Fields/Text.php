<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Edit\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

class Text extends AbstractField
{

    private $hint = '';

    public function getTemplate()
    {
        return 'components/edit/fields/text';
    }

    /**
     * @return string
     */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
     * @param string $hint
     */
    public function setHint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }


}
