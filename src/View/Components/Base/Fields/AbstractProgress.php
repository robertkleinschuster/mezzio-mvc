<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base\Fields;

use Pars\Mvc\View\Components\Base\AbstractField;

/**
 * Class AbstractProgress
 * @package Pars\Mvc\View\Components\Base\Fields
 */
abstract class AbstractProgress extends AbstractField
{
    public const TYPE_STRIPED = 'striped';
    public const TYPE_ANIMATED = 'animated';

    /**
     * @var int
     */
    private ?int $height = null;

    /**
     * @var string
     */
    private ?string $label = null;

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
        return 'components/base/fields/progress';
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     *
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasHeight(): bool
    {
        return $this->height !== null;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasLabel(): bool
    {
        return $this->label !== null;
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
