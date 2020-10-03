<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;
use NiceshopsDev\Bean\BeanFormatter\BeanFormatterAwareInterface;
use NiceshopsDev\Bean\BeanFormatter\BeanFormatterAwareTrait;
use NiceshopsDev\Bean\BeanFormatter\BeanFormatterInterface;
use NiceshopsDev\NiceCore\Attribute\AttributeAwareInterface;
use NiceshopsDev\NiceCore\Attribute\AttributeTrait;
use NiceshopsDev\NiceCore\Option\OptionAwareInterface;
use NiceshopsDev\NiceCore\Option\OptionTrait;

class View implements OptionAwareInterface, AttributeAwareInterface, BeanFormatterAwareInterface
{
    use OptionTrait;
    use AttributeTrait;
    use BeanFormatterAwareTrait;

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
     * @var int
     */
    private $cols;

    /**
     * @var string
     */
    private $indexLink;

    /**
     * @var array
     */
    private $permission_List;


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
        if ($this->hasPermissionList()) {
            $componentList = $this->component_List;
            return array_filter($componentList, function ($component) {
                return !$component->hasPermission() || in_array($component->getPermission(), $this->getPermissionList());
            });
        }
        return $this->component_List;
    }


    /**
     * @param AbstractComponent $component
     * @param bool $prepend
     */
    public function addComponent(AbstractComponent $component, bool $prepend = false)
    {
        if ($this->hasPermissionList()) {
            $component->setPermissionList($this->getPermissionList());
            if ($component->hasPermission() && !in_array($component->getPermission(), $this->getPermissionList())) {
                return;
            }
        }
        if ($this->hasBeanFormatter()) {
            $component->setBeanFormatter($this->getBeanFormatter());
        }
        if ($prepend) {
            array_unshift($this->component_List, $component);
        } else {
            $this->component_List[] = $component;
        }
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
     * @return int
     */
    public function getCols(): int
    {
        return $this->cols ?? 1;
    }

    /**
     * @param int $cols
     */
    public function setCols(int $cols)
    {
        $this->cols = $cols;
        return $this;
    }

    /**
     * @return string
     */
    public function getIndexLink(): string
    {
        return $this->indexLink ?? '/';
    }

    /**
     * @param string $indexLink
     */
    public function setIndexLink(string $indexLink)
    {
        $this->indexLink = $indexLink;
        return $this;
    }

    /**
    * @return array
    */
    public function getPermissionList(): array
    {
        return $this->permission_List;
    }

    /**
    * @param array $permission_List
    *
    * @return $this
    */
    public function setPermissionList(array $permission_List): self
    {
        $this->permission_List = $permission_List;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasPermissionList(): bool
    {
        return $this->permission_List !== null;
    }


    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'view';
    }
}
