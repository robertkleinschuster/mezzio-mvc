<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base\Fields;

abstract class AbstractBlockquote extends AbstractText
{

    /**
     * @var string
     */
    private ?string $footer = null;

    /**
     * @var string
     */
    private ?string $source = null;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/blockquote';
    }


    /**
     * @return string
     */
    public function getFooter(): string
    {
        return $this->footer;
    }

    /**
     * @param string $footer
     *
     * @return $this
     */
    public function setFooter(string $footer): self
    {
        $this->footer = $footer;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasFooter(): bool
    {
        return $this->footer !== null;
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
