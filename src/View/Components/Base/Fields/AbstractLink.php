<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Base\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

abstract class AbstractLink extends AbstractField
{

    public const TARGET_BLANK = '_blank';
    public const TARGET_SELF = '_self';
    public const TARGET_PARENT = '_parent';
    public const TARGET_TOP = '_top';


    /**
     * @var string
     */
    private $target;

    /**
     * @var string
     */
    private $action;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/link';
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     *
     * @return $this
     */
    public function setTarget(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasTarget(): bool
    {
        return $this->target !== null;
    }

    /**
     * @return string
     */
    public function getAction(?array $data_Map = null): string
    {
        if (null === $data_Map) {
            return $this->action;
        } else {
            return $this->replacePlaceholders($this->action, $data_Map);
        }
    }

    /**
     * @param string $action
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
}
