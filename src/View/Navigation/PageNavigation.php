<?php


namespace Mezzio\Mvc\View\Navigation;


class PageNavigation
{
    /**
     * @var PageNavigationElement[]
     */
    private $element_List;

    /**
     * @var int
     */
    private $active;

    /**
     * @return PageNavigationElement[]
     */
    public function getElementList(): array
    {
        return $this->element_List ?? [];
    }

    /**
     * @param PageNavigationElement[] $element_List
     */
    public function setElementList(array $element_List): void
    {
        $this->element_List = $element_List;
    }

    /**
     * @param PageNavigationElement $element
     * @return $this
     */
    public function addElement(PageNavigationElement $element): self
    {
        $this->element_List[] = $element;
        return $this;
    }


    /**
     * @param int $index
     * @return PageNavigationElement
     */
    public function getElement(int $index): PageNavigationElement
    {
        return $this->element_List[$index];
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active ?? 0;
    }

    /**
     * @param int $active
     * @return PageNavigation
     */
    public function setActive(int $active): self
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFirst(): bool
    {
        return $this->getActive() == 0;
    }

    /**
     * @return bool
     */
    public function isLast(): bool
    {
        return $this->getActive() == count($this->element_List) - 1;
    }

    /**
     * @return PageNavigationElement
     */
    public function getPrevious(): PageNavigationElement
    {
        if ($this->isFirst()) {
            return $this->getElement($this->getActive());
        } else {
            return $this->getElement($this->getActive() - 1);
        }
    }

    /**
     * @return PageNavigationElement
     */
    public function getNext(): PageNavigationElement
    {
        if ($this->isLast()) {
            return $this->getElement($this->getActive());
        } else {
            return $this->getElement($this->getActive() + 1);
        }
    }

}
