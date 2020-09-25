<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;
use NiceshopsDev\NiceCore\Option\OptionAwareInterface;
use NiceshopsDev\NiceCore\Option\OptionTrait;

class View implements OptionAwareInterface
{
    use OptionTrait;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $layout;

    /**
     * @var AbstractComponent[]
     */
    private $component_List;

    /**
     * @var ViewModelInterface
     */
    private $viewModel;

    /**
     * View constructor.
     * @param string $title
     * @param ViewModelInterface $viewModel
     */
    public function __construct(string $title, ViewModelInterface $viewModel)
    {
        $this->title = $title;
        $this->component_List = [];
        $this->viewModel = $viewModel;
    }

    /**
     * @return ViewModelInterface
     */
    public function getViewModel(): ViewModelInterface
    {
        return $this->viewModel;
    }

    /**
     * @param ViewModelInterface $viewModel
     */
    public function setViewModel(ViewModelInterface $viewModel): void
    {
        $this->viewModel = $viewModel;
    }


    /**
     * @return AbstractComponent[]
     */
    public function getComponentList(): array
    {
        return $this->component_List;
    }

    /**
     * @param AbstractComponent[] $component_List
     */
    public function setComponentList(array $component_List): void
    {
        $this->component_List = $component_List;
    }

    /**
     * @param AbstractComponent $component
     */
    public function addComponent(AbstractComponent $component)
    {
        $this->component_List[] = $component;
    }

    /**
     * @return mixed
     */
    public function getLayout(): string
    {
        return $this->layout ?? 'layout/default';
    }

    /**
     * @param string $layout
     * @return $this
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author ?? '';
    }

    /**
     * @param string $author
     * @return $this;
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    /**
     * @param string $description
     * @return $this;
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'view';
    }
}
