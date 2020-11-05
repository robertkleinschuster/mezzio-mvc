<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base\Fields;

/**
 * Class AbstractCodeblock
 * @package Pars\Mvc\View\Components\Base\Fields
 */
abstract class AbstractCodeblock extends AbstractText
{

    /**
     * @var bool
     */
    private ?bool $scrollable = null;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/codeblock';
    }

    /**
     * @return bool
     */
    public function isScrollable(): bool
    {
        return $this->scrollable ?? false;
    }

    /**
     * @param bool $scrollable
     * @return AbstractCodeblock
     */
    public function setScrollable(bool $scrollable): self
    {
        $this->scrollable = $scrollable;
        return $this;
    }
}
