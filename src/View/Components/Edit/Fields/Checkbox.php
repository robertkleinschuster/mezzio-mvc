<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Edit\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

class Checkbox extends AbstractField
{

    private $hint = '';

    /**
     * @var bool
     */
    private $checked;

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
    public function setHint(string $hint): void
    {
        $this->hint = $hint;
    }

    /**
     * @return bool
     */
    public function isChecked(): bool
    {
        return $this->checked ?? false;
    }

    /**
     * @param bool $checked
     */
    public function setChecked(bool $checked): void
    {
        $this->checked = $checked;
    }
}
