<?php

namespace Mezzio\Mvc\View\Navigation;

class Navigation
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var Action
     */
    private $action;

    /**
     * @var Element[]
     */
    private $element_List;

    /**
     * @var Element[]
     */
    private $permissionList;

    /**
     * Navigation constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return Element[]
     */
    public function getElementList(): array
    {
        if ($this->hasPermissionList()) {
            return array_filter($this->permissionList, function ($element) {
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
     */
    public function setAction(Action $action): void
    {
        $this->action = $action;
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


}
