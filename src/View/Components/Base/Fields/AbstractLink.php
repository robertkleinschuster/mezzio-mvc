<?php

declare(strict_types=1);

namespace Mvc\View\Components\Base\Fields;

use Mvc\View\Components\Base\AbstractField;
use Mvc\View\Components\Base\IconAwareInterface;
use Mvc\View\Components\Base\IconAwareTrait;

abstract class AbstractLink extends AbstractField implements IconAwareInterface
{
    use IconAwareTrait;

    public const OPTION_BUTTON_STYLE = 'button_style';
    public const OPTION_TEXT_DECORATION_NONE = 'text-decoration-none';

    public const SIZE_SMALL = 'sm';
    public const SIZE_LARGE = 'lg';
    public const SIZE_BLOCK = 'block';

    /**
     * @var string
     */
    private $style;

    /**
     * @var string
     */
    private $size;

    /**
     * @var bool
     */
    private $outline;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/link';
    }

    /**
     * @return string
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @param string $style
     *
     * @return $this
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasStyle(): bool
    {
        return $this->style !== null;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     *
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
    public function hasSize(): bool
    {
        return $this->size !== null;
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
     *
     * @return $this
     */
    public function setOutline(bool $outline): self
    {
        $this->outline = $outline;
        return $this;
    }


    /**
     * @return string
     */
    public function getClass(): string
    {
        $result = "mr-1 ";
        if ($this->hasOption(self::OPTION_BUTTON_STYLE)) {
            $result = ' btn';
            if ($this->hasStyle()) {
                if ($this->isOutline()) {
                    $result .= ' btn-outline-' . $this->getStyle();
                } else {
                    $result .= ' btn-' . $this->getStyle();
                }
            }
            if ($this->hasSize()) {
                $result .= ' btn-' . $this->getSize();
            }
        } else {
            if ($this->hasStyle()) {
                $result .= ' text-' . $this->getStyle();
            }
        }
        if ($this->hasOption(self::OPTION_TEXT_DECORATION_NONE)) {
            $result .= ' text-decoration-none';
        }
        return $result;
    }
}
