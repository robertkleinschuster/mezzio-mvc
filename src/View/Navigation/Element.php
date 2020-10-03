<?php

namespace Mezzio\Mvc\View\Navigation;


class Element
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $link;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var string
     */
    private $permission;

    /**
     * Element constructor.
     * @param string $name
     * @param string $link
     */
    public function __construct(string $name, string $link)
    {
        $this->name = $name;
        $this->link = $link;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function hasName(): bool
    {
        return $this->name !== null;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }


    /**
     * @return bool
     */
    public function hasIcon(): bool
    {
        return $this->icon !== null;
    }


    /**
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }


    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return bool
     */
    public function hasLink(): bool
    {
        return $this->link !== null;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active ?? false;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }


    /**
    * @return string
    */
    public function getPermission(): string
    {
        return $this->permission;
    }

    /**
    * @param string $permission
    *
    * @return $this
    */
    public function setPermission(string $permission): self
    {
        $this->permission = $permission;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasPermission(): bool
    {
        return $this->permission !== null;
    }

}
