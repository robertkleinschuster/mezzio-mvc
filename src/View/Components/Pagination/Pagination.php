<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Pagination;

use Pars\Mvc\View\Components\Base\AbstractComponent;
use Pars\Mvc\View\Components\Pagination\Fields\Link;

/**
 * Class Pagination
 * @package Pars\Mvc\View\Components\Pagination
 * @method Link[] getFieldList() : array
 */
class Pagination extends AbstractComponent
{

    /**
     * @var int|null
     */
    private ?int $active = null;

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'components/pagination/pagination';
    }


    /**
     * @param int $index
     * @return Link
     */
    public function getField(int $index): Link
    {
        return $this->getFieldList()[$index];
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
     * @return Pagination
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
        return $this->getActive() == count($this->getFieldList()) - 1;
    }

    /**
     * @return Link
     */
    public function getPrevious(): Link
    {
        if ($this->isFirst()) {
            return $this->getField($this->getActive());
        } else {
            return $this->getField($this->getActive() - 1);
        }
    }

    /**
     * @return Link
     */
    public function getNext(): Link
    {
        if ($this->isLast()) {
            return $this->getField($this->getActive());
        } else {
            return $this->getField($this->getActive() + 1);
        }
    }

    /**
     * @param string $link
     * @return Link
     */
    public function addLink(string $link): Link
    {
        $field = new Link($link);
        $field->setLink($link);
        return $field;
    }
}
