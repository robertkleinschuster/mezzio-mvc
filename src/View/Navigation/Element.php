<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Navigation;

use Pars\Mvc\Helper\PathHelperAwareInterface;
use Pars\Mvc\Helper\PathHelperAwareTrait;

/**
 * Class Element
 * @package Pars\Mvc\View\Navigation
 */
class Element implements PathHelperAwareInterface
{
    use PathHelperAwareTrait;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $link;

    /**
     * @var string
     */
    private ?string $icon = null;

    /**
     * @var string
     */
    private ?string $permission = null;

    /**
     * @var int
     */
    private int $index = 0;

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
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @param int $index
     * @return Element
     */
    public function setIndex(int $index)
    {
        $this->index = $index;
        return $this;
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
        return $this->link ?? $this->getPathHelper()->getPath(false);
    }

    /**
     * @return bool
     */
    public function hasLink(): bool
    {
        return $this->link !== null || $this->hasPathHelper();
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
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
