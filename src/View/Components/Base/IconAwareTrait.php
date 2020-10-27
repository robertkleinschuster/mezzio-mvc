<?php
declare(strict_types=1);


namespace Mvc\View\Components\Base;


trait IconAwareTrait
{
    private ?string $icon = null;

    /**
    * @return string
    */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
    * @param string $icon
    *
    * @return $this
    */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasIcon(): bool
    {
        return $this->icon !== null;
    }

}
