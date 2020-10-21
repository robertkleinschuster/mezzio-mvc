<?php


namespace Mvc\View\Components\Base\Fields;

class AbstractWysiwyg extends AbstractTextarea
{

    public const TYPE_TOOLTIP = 'tooltip';
    public const TYPE_TOOLBAR = 'toolbar';

    private ?string $type;


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
