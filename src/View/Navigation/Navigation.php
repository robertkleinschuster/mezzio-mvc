<?php

declare(strict_types=1);

namespace Mvc\View\Navigation;

class Navigation
{

    public const POSITION_SIDEBAR = 'sidebar';
    public const POSITION_HEADER = 'header';

    /**
     * @var string
     */
    private string $title;

    /**
     * @var Action
     */
    private ?Action $action = null;

    /**
     * @var Element[]
     */
    private array $element_List = [];

    /**
     * @var Element[]
     */
    private ?array $permissionList = null;

    /**
     * @var string
     */
    private ?string $permission = null;

    /**
     * @var string
     */
    private string $position;

    /**
     * Navigation constructor.
     * @param string $title
     * @param string $position
     */
    public function __construct(string $title, string $position = self::POSITION_SIDEBAR)
    {
        $this->title = $title;
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }


    /**
     * @return Element[]
     */
    public function getElementList(): array
    {
        if ($this->hasPermissionList()) {
            return array_filter($this->element_List, function ($element) {
                return !$element->hasPermission() || in_array($element->getPermission(), $this->getPermissionList());
            });
        }
        return $this->element_List;
    }

    /**
     * @param Element[] $element_List
     */
    public function setElementList(array $element_List): void
    {
        $this->element_List = $element_List;
    }

    /**
     * @param Element $element
     */
    public function addElement(Element $element)
    {
        $this->element_List[] = $element;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return bool
     */
    public function hasTitle(): bool
    {
        return $this->title !== null;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return Action
     */
    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * @return bool
     */
    public function hasAction(): bool
    {
        return $this->action !== null;
    }

    /**
     * @param Action $action
     * @return Navigation
     */
    public function setAction(Action $action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return array
     */
    public function getPermissionList(): array
    {
        return $this->permissionList;
    }

    /**
     * @param array $permissionList
     *
     * @return $this
     */
    public function setPermissionList(array $permissionList): self
    {
        $this->permissionList = $permissionList;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasPermissionList(): bool
    {
        return $this->permissionList !== null;
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
