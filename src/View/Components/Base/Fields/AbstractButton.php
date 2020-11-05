<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base\Fields;

use Pars\Mvc\View\Components\Base\AbstractField;

/**
 * Class AbstractButton
 * @package Pars\Mvc\View\Components\Base\Fields
 */
abstract class AbstractButton extends AbstractField
{

    public const TYPE_BUTTON = 'button';
    public const TYPE_SUBMIT = 'submit';
    public const TYPE_RESET = 'reset';

    public const STYLE_LINK = 'link';

    public const SIZE_SMALL = 'sm';
    public const SIZE_LARGE = 'lg';
    public const SIZE_BLOCK = 'block';

    /**
     * @var string
     */
    private ?string $type = null;

    /**
     * @var bool
     */
    private ?bool $outline = null;

    /**
     * @var string
     */
    private ?string $style = null;

    /**
     * @var string
     */
    private ?string $size = null;

    /**
     * @var bool
     */
    private ?bool $disabled = null;

    /**
     * @var string
     */
    private ?string $tooltip = null;


    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/button';
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type ?? 'button';
    }

    /**
     * @param mixed $type
     */
    public function setType($type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOutline(): bool
    {
        return $this->outline ?? false;
    }

    /**
     * @param bool $outline
     */
    public function setOutline(bool $outline): self
    {
        $this->outline = $outline;
        return $this;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @return bool
     */
    public function hasSize(): bool
    {
        return $this->size !== null;
    }

    /**
     * @param string $size
     * @return $this
     */
    public function setSize(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled ?? false;
    }

    /**
     * @param bool $disabled
     * @return $this
     */
    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getStyle(): string
    {
        return $this->style ?? self::STYLE_PRIMARY;
    }

    /**
     * @param string $style
     * @return $this
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        $class = 'btn mr-1 ';
        if ($this->isOutline()) {
            $class .= ' btn-outline-' . $this->getStyle();
        } else {
            $class .= ' btn-' . $this->getStyle();
        }

        if ($this->hasSize()) {
            $class .= ' btn-' . $this->getSize();
            if ($this->getSize() == self::SIZE_BLOCK) {
                $class .= ' btn-' . self::SIZE_LARGE;
            }
        }
        return $class;
    }

    /**
     * @return string
     */
    public function getTooltip(): string
    {
        return $this->tooltip;
    }

    /**
     * @param string $tooltip
     *
     * @return $this
     */
    public function setTooltip(string $tooltip): self
    {
        $this->tooltip = $tooltip;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasTooltip(): bool
    {
        return $this->tooltip !== null;
    }
}
