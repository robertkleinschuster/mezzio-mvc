<?php
declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base;

/**
 * Trait LinkAwareTrait
 * @package Pars\Mvc\View\Components\Base
 */
trait LinkAwareTrait
{
    /**
     * @var string
     */
    private ?string $target = null;

    /**
     * @var string
     */
    private ?string $link = null;

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
    public function setTarget(string $target)
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
    public function getLink(): string
    {
        return $this->link;
    }

    /**
    * @param string $link
    *
    * @return $this
    */
    public function setLink(string $link)
    {
        $this->link = $link;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasLink(): bool
    {
        return $this->link !== null;
    }

}
