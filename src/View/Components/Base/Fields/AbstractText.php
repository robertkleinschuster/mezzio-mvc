<?php

declare(strict_types=1);

namespace Mvc\View\Components\Base\Fields;

use Mvc\View\Components\Base\AbstractField;

abstract class AbstractText extends AbstractField
{

    public const ALIGN_LEFT = 'left';
    public const ALIGN_CENTER = 'center';
    public const ALIGN_RIGHT = 'right';

    public const OPTION_RESET_COLOR = 'text-reset';
    public const OPTION_MONOSPACE = 'text-monospace';
    public const OPTION_DECORATION_NONE = 'text-decoration-none';
    public const OPTION_ITALIC = 'font-italic';
    public const OPTION_WORD_BREAK = 'text-break';
    public const OPTION_TRUNCATE = 'text-truncate';


    /**
     * @var string
     */
    private $align;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/text';
    }

    /**
     * @return string
     */
    public function getAlign(): string
    {
        return $this->align;
    }

    /**
     * @param string align
     *
     * @return $this
     */
    public function setAlign(string $align): self
    {
        $this->align = $align;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAlign(): bool
    {
        return $this->align !== null;
    }
}
