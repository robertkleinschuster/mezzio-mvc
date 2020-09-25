<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Base\Fields;

abstract class AbstractImage extends AbstractText
{

    public const SIZE_FLUID = 'fluid';
    public const SIZE_THUMBNAIL = 'thumbnail';


    /**
     * @var string
     */
    private $source;

    /**
     * @var
     */
    private $size;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/image';
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     *
     * @return $this
     */
    public function setSource(string $source): self
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSource(): bool
    {
        return $this->source !== null;
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
}
