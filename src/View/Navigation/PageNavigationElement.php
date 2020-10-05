<?php


namespace Mezzio\Mvc\View\Navigation;


class PageNavigationElement
{

    /**
     * @var string
     */
    private $link;

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link ?? '';
    }

    /**
     * @param string $link
     * @return PageNavigationElement
     */
    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }



}
