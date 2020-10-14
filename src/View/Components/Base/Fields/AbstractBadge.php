<?php

declare(strict_types=1);

namespace Mvc\View\Components\Base\Fields;

use Mvc\View\Components\Base\AbstractField;
use NiceshopsDev\Bean\BeanInterface;

abstract class AbstractBadge extends AbstractField
{
    public const TYPE_PILL = 'pill';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $action;


    /**
     * @var string
     */
    private $style;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/badge';
    }


    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string type
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
     * @param BeanInterface|null $bean
     * @return string
     */
    public function getAction(?BeanInterface $bean = null): string
    {
        if (null === $bean) {
            return $this->action;
        } else {
            return $this->replacePlaceholders($this->action, $bean);
        }
    }

    /**
     * @param string action
     *
     * @return $this
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAction(): bool
    {
        return $this->action !== null;
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
