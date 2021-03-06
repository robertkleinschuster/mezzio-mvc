<?php

declare(strict_types=1);

namespace Mvc\View\Components\Base\Fields;

abstract class AbstractFigure extends AbstractText
{

    /**
     * @var string
     */
    private $source;


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
}
