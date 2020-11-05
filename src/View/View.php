<?php

declare(strict_types=1);

namespace Pars\Mvc\View;

use Niceshops\Bean\Converter\BeanConverterAwareInterface;
use Niceshops\Bean\Converter\BeanConverterAwareTrait;
use Niceshops\Bean\Type\Base\BeanException;
use Niceshops\Core\Attribute\AttributeAwareInterface;
use Niceshops\Core\Attribute\AttributeAwareTrait;
use Niceshops\Core\Option\OptionAwareInterface;
use Niceshops\Core\Option\OptionAwareTrait;
use Pars\Mvc\Bean\TemplateDataBean;
use Pars\Mvc\View\Components\Base\AbstractComponent;
use Pars\Mvc\View\Components\Toolbar\Toolbar;
use Pars\Mvc\View\Navigation\Navigation;

/**
 * Class View
 * @package Pars\Mvc\View
 */
class View implements OptionAwareInterface, AttributeAwareInterface, BeanConverterAwareInterface
{
    use OptionAwareTrait;
    use AttributeAwareTrait;
    use BeanConverterAwareTrait;

    /**
     * @var string
     */
    private string $layout;

    /**
     * @var int
     */
    private int $cols = 1;

    /**
     * @var AbstractComponent[]
     */
    private array $component_List = [];

    /**
     * @var Navigation[]
     */
    private array $navigation_List;

    /**
     * @var array
     */
    private ?array $permission_List = null;

    /**
     * @var Toolbar
     */
    private ?Toolbar $toolbar = null;


    /**
     * @var TemplateDataBean
     */
    private ?TemplateDataBean $templateData = null;


    /**
     * View constructor.
     * @param string $layout
     */
    public function __construct(string $layout)
    {
        $this->layout = $layout;
        $this->component_List = [];
        $this->navigation_List = [];
    }


    /**
     * @return TemplateDataBean
     */
    public function getTemplateData(): TemplateDataBean
    {
        if (null == $this->templateData) {
            $this->templateData = new TemplateDataBean();
        }
        return $this->templateData;
    }

    /**
     * @return AbstractComponent[]
     */
    public function getComponentList(): array
    {
        if ($this->hasPermissionList()) {
            $componentList = $this->component_List;
            return array_values(array_filter($componentList, function ($component) {
                return !$component->hasPermission() ||
                    in_array($component->getPermission(), $this->getPermissionList());
            }));
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
        return $this->layout;
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
     * @return int
     */
    public function getCols(): int
    {
        return $this->cols;
    }

    /**
     * @param int $cols
     * @return View
     */
    public function setCols(int $cols)
    {
        $this->cols = $cols;
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
     * @param string $position
     * @return Navigation[]
     */
    public function getNavigationList(string $position = Navigation::POSITION_SIDEBAR): array
    {
        if ($this->hasPermissionList()) {
            return array_values(array_filter($this->navigation_List, function ($navigation) use ($position) {
                return $navigation->getPosition() === $position
                    && (!$navigation->hasPermission() || in_array($navigation->getPermission(), $this->getPermissionList()));
            }));
        }
        return array_values(array_filter($this->navigation_List, function ($navigation) use ($position) {
            return $navigation->getPosition() === $position;
        }));
    }

    /**
     * @param string $position
     * @return bool
     */
    public function hasNavigation(string $position = Navigation::POSITION_SIDEBAR): bool
    {
        return count($this->getNavigationList($position)) > 0;
    }

    /**
     * @param Navigation $navigation
     * @return View
     */
    public function addNavigation(Navigation $navigation)
    {
        if ($this->hasPermissionList()) {
            $navigation->setPermissionList($this->getPermissionList());
            if (!$navigation->hasPermission() || in_array($navigation->getPermission(), $this->getPermissionList())) {
                $this->navigation_List[] = $navigation;
            }
        } else {
            $this->navigation_List[] = $navigation;
        }
        return $this;
    }

    /**
     * @return Toolbar
     */
    public function getToolbar(): Toolbar
    {
        return $this->toolbar;
    }

    /**
     * @param Toolbar $toolbar
     *
     * @return $this
     */
    public function setToolbar(Toolbar $toolbar): self
    {
        if ($this->hasPermissionList()) {
            $toolbar->setPermissionList($this->getPermissionList());
        }
        $this->toolbar = $toolbar;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasToolbar(): bool
    {
        return $this->toolbar !== null;
    }


    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'view';
    }

    /**
     * @param string $name
     * @return bool
     * @throws BeanException
     */
    public function hasData(string $name): bool
    {
        return $this->getTemplateData()->hasData($name);
    }

    /**
     * @param string $name
     * @return mixed|null
     * @throws BeanException
     */
    public function getData(string $name)
    {
        return $this->getTemplateData()->getData($name);
    }

    /**
     * @param string $name
     * @param $value
     * @return $this
     * @throws BeanException
     */
    public function setData(string $name, $value): self
    {
        $this->getTemplateData()->setData($name, $value);
        return $this;
    }

    /**
     * @param string $title
     * @return $this
     * @throws BeanException
     */
    public function setTitle(string $title): self
    {
        $this->setData('title', $title);
        return $this;
    }

    /**
     * @param string $heading
     * @return $this
     * @throws BeanException
     */
    public function setHeading(string $heading): self
    {
        $this->setData('heading', $heading);
        return $this;
    }

    /**
     * @param string $description
     * @return $this
     * @throws BeanException
     */
    public function setDescription(string $description): self
    {
        $this->setData('description', $description);
        return $this;
    }

    /**
     * @param string $author
     * @return $this
     * @throws BeanException
     */
    public function setAuthor(string $author): self
    {
        $this->setData('author', $author);
        return $this;
    }

    /**
     * @param string $favicon
     * @return $this
     * @throws BeanException
     */
    public function setFavicon(string $favicon): self
    {
        $this->setData('favicon', $favicon);
        return $this;
    }

    /**
     * @param string $logo
     * @return $this
     * @throws BeanException
     */
    public function setLogo(string $logo): self
    {
        $this->setData('logo', $logo);
        return $this;
    }
}
