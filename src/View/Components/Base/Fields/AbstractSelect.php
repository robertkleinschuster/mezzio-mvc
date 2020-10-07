<?php

declare(strict_types=1);

namespace Mvc\View\Components\Base\Fields;

abstract class AbstractSelect extends AbstractRadioButtonGroup
{
    /**
     * @var int
     */
    private $size;

    /**
     * @var bool
     */
    private $multiple;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/select';
    }


    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size ?? 1;
    }

    /**
     * @param int $size
     * @return AbstractSelect
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple ?? false;
    }

    /**
     * @param bool $multiple
     * @return AbstractSelect
     */
    public function setMultiple(bool $multiple): self
    {
        $this->multiple = $multiple;
        return $this;
    }
}
