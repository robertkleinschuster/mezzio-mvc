<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base\Fields;

/**
 * Class AbstractWysiwyg
 * @package Pars\Mvc\View\Components\Base\Fields
 */
abstract class AbstractWysiwyg extends AbstractTextarea
{

    public const TYPE_TOOLTIP = 'tooltip';
    public const TYPE_TOOLBAR = 'toolbar';

    private ?string $type = null;


    public function getTemplate()
    {
        return 'components/base/fields/wysiwyg';
    }

    /**
    * @return string
    */
    public function getType(): string
    {
        return $this->type ?? self::TYPE_TOOLBAR;
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
}
