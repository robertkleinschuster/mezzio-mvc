<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Base\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

abstract class AbstractCheckbox extends AbstractField implements RequiredAwareInterface
{
    use RequiredAwareTrait;

    /**
     * @var string
     */
    private $hint;

    /**
     * @var bool
     */
    private $checked;


    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/checkbox';
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
     *
     * @return $this
     */
    public function setHint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasHint(): bool
    {
        return $this->hint !== null;
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
    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;
        return $this;
    }

}
