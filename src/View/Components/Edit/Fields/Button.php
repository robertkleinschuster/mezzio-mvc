<?php

namespace Mezzio\Mvc\View\Components\Edit\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

class Button extends AbstractField
{

    public const TYPE_BUTTON = 'button';
    public const TYPE_SUBMIT = 'submit';
    public const TYPE_RESET = 'reset';


    public const STYLE_PRIMARY = 'primary';
    public const STYLE_SECONDARY = 'secondary';
    public const STYLE_SECCESS = 'success';
    public const STYLE_DANGER = 'danger';
    public const STYLE_WARNING = 'warning';
    public const STYLE_INFO = 'info';
    public const STYLE_LIGHT = 'light';
    public const STYLE_DARK = 'dark';
    public const STYLE_LINK = 'link';

    public const SIZE_SMALL = 'sm';
    public const SIZE_LARGE = 'lg';
    public const SIZE_BLOCK = 'block';


    /**
     * @var string
     */
    private $type;

    /**
     * @var bool
     */
    private $outline;

    /**
     * @var string
     */
    private $style;


    /** @var string */
    private $size;

    /**
     * @var bool
     */
    private $disabled;


    public function getTemplate()
    {
        return 'components/edit/fields/button';
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
    public function setType($type): void
    {
        $this->type = $type;
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
    public function setOutline(bool $outline): void
    {
        $this->outline = $outline;
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
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
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
     */
    public function setDisabled(bool $disabled): void
    {
        $this->disabled = $disabled;
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
     */
    public function setStyle(string $style): void
    {
        $this->style = $style;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        $class = 'btn';
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
}
