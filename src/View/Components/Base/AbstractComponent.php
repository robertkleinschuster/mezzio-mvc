<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Base;

use Mezzio\Mvc\View\ComponentModelInterface;

abstract class AbstractComponent
{

    /**
     * @var string
     */
    private $title;

    /**
     * @var AbstractField[]
     */
    private $field_List;

    /**
     * @var ComponentModelInterface
     */
    private $componentModel;

    /**
     * AbstractComponent constructor.
     * @param string $title
     * @param ComponentModelInterface $componentModel
     */
    public function __construct(string $title, ComponentModelInterface $componentModel)
    {
        $this->field_List = [];
        $this->title = $title;
        $this->componentModel = $componentModel;
    }

    /**
     * @return ComponentModelInterface
     */
    public function getComponentModel(): ComponentModelInterface
    {
        return $this->componentModel;
    }

    /**
     * @param ComponentModelInterface $componentModel
     */
    public function setComponentModel(ComponentModelInterface $componentModel): self
    {
        $this->componentModel = $componentModel;
        return $this;
    }


    /**
     * @return AbstractField[]
     */
    public function getFieldList(): array
    {
        return $this->field_List;
    }

    /**
     * @param AbstractField[] $field_List
     */
    public function setFieldList(array $field_List): self
    {
        $this->field_List = $field_List;
        return $this;
    }

    /**
     * @param AbstractField $field
     */
    public function addField(AbstractField $field): self
    {
        $this->field_List[] = $field;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }


    /**
     * @return string
     */
    abstract public function getTemplate(): string;
}
