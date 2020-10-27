<?php
declare(strict_types=1);


namespace Mvc\View\Components\Base;


use Mvc\View\Components\Base\Fields\AbstractLink;

trait LinkAwareTrait
{
    /**
     * @var string
     */
    private $target;

    /**
     * @var string
     */
    private $link;

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
