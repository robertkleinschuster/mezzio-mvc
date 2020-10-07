<?php

declare(strict_types=1);

namespace Mvc\View\Components\Base;

use Mvc\View\ComponentModel;
use Mvc\View\ComponentModelInterface;
use NiceshopsDev\Bean\BeanFormatter\BeanFormatterAwareInterface;
use NiceshopsDev\Bean\BeanFormatter\BeanFormatterAwareTrait;
use NiceshopsDev\NiceCore\Attribute\AttributeAwareInterface;
use NiceshopsDev\NiceCore\Attribute\AttributeTrait;
use NiceshopsDev\NiceCore\Option\OptionAwareInterface;
use NiceshopsDev\NiceCore\Option\OptionTrait;

abstract class AbstractComponent implements OptionAwareInterface, AttributeAwareInterface, BeanFormatterAwareInterface
{
    use OptionTrait;
    use AttributeTrait;
    use BeanFormatterAwareTrait;

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
     * @var int
     */
    private $cols;


    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $permission_List;

    /**
     * @var string
     */
    private $permission;


    /**
     * AbstractComponent constructor.
     * @param string $title
     * @param ComponentModelInterface $componentModel
     */
    public function __construct(string $title = null, ?ComponentModelInterface $componentModel = null)
    {
        $this->field_List = [];
        $this->title = $title;
        $this->componentModel = $componentModel ?? new ComponentModel();
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
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasTitle(): bool
    {
        return $this->title !== null;
    }

    /**
     * @return ComponentModelInterface
     */
    public function getComponentModel(): ComponentModelInterface
    {
        return $this->componentModel;
    }

    /**
     * @return AbstractField[]
     */
    public function getFieldList(): array
    {
        if ($this->hasPermissionList()) {
            return array_filter($this->field_List, function ($field) {
                return !$field->hasPermission() || in_array($field->getPermission(), $this->getPermissionList());
            });
        }
        return $this->field_List;
    }

    /**
     * @param AbstractField $field
     * @return $this
     */
    protected function addField(AbstractField $field): self
    {
        if (
            !$this->hasPermissionList()
            || !$field->hasPermission()
            || in_array($field->getPermission(), $this->getPermissionList())
        ) {
            if ($this->hasBeanFormatter()) {
                $field->setBeanFormatter($this->getBeanFormatter());
            }
            $this->field_List[] = $field;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'components/base/component';
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
    public function setCols(int $cols): void
    {
        $this->cols = $cols;
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


    /**
     * @return string
     */
    public function getId(): string
    {
        if (null === $this->id) {
            $this->id = preg_replace("/[^a-zA-Z]/", "", md5(serialize($this)));
        }
        return $this->id;
    }
}
