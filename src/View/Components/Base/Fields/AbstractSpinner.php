<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base\Fields;

/**
 * Class AbstractSpinner
 * @package Pars\Mvc\View\Components\Base\Fields
 */
abstract class AbstractSpinner extends AbstractText
{
    public const TYPE_BORDER = 'border';
    public const TYPE_GROW = 'grow';

    /**
     * @var string
     */
    private ?string $type = null;

    /**
     * @var string
     */
    private ?string $style = null;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/spinner';
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasType(): bool
    {
        return $this->type !== null;
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
}
