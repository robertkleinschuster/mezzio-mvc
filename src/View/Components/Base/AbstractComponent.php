<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base;

use Niceshops\Bean\Converter\BeanConverterAwareInterface;
use Niceshops\Bean\Converter\BeanConverterAwareTrait;
use Niceshops\Bean\Type\Base\BeanInterface;
use Niceshops\Bean\Type\Base\BeanListAwareInterface;
use Niceshops\Bean\Type\Base\BeanListAwareTrait;
use Niceshops\Core\Attribute\AttributeAwareInterface;
use Niceshops\Core\Attribute\AttributeAwareTrait;
use Niceshops\Core\Option\OptionAwareInterface;
use Niceshops\Core\Option\OptionAwareTrait;
use Pars\Mvc\Helper\ValidationHelperAwareInterface;
use Pars\Mvc\Helper\ValidationHelperAwareTrait;
use Pars\Mvc\View\ComponentDataBean;
use Pars\Mvc\View\ComponentDataBeanList;
use Pars\Mvc\View\ViewException;

/**
 * Class AbstractComponent
 * @package Pars\Mvc\View\Components\Base
 */
abstract class AbstractComponent implements
    OptionAwareInterface,
    AttributeAwareInterface,
    BeanConverterAwareInterface,
    ValidationHelperAwareInterface,
    BeanListAwareInterface
{
    use OptionAwareTrait;
    use AttributeAwareTrait;
    use BeanConverterAwareTrait;
    use ValidationHelperAwareTrait;
    use BeanListAwareTrait;

    /**
     * @var string
     */
    private ?string $title;

    /**
     * @var AbstractField[]
     */
    private array $field_List;

    /**
     * @var int
     */
    private ?int $cols = null;

    /**
     * @var string
     */
    private string $id;

    /**
     * @var array
     */
    private ?array $permission_List = null;

    /**
     * @var string
     */
    private ?string $permission = null;


    /**
     * AbstractComponent constructor.
     * @param string $title
     */
    public function __construct(?string $title = null)
    {
        $this->field_List = [];
        $this->title = $title;
        $this->setBeanList(new ComponentDataBeanList());
        $this->setBean(new ComponentDataBean());
        $this->id = (string)preg_replace("/[^a-zA-Z]/", "", md5(serialize($this)));
    }

    /**
     * @param BeanInterface $bean
     * @return $this
     */
    public function addBean(BeanInterface $bean)
    {
        $this->getBeanList()->addBean($bean);
        return $this;
    }

    /**
     * @param BeanInterface $bean
     * @return $this
     */
    public function setBean(BeanInterface $bean)
    {
        $this->getBeanList()->resetBeans();
        $this->getBeanList()->offsetSet(0, $bean);
        return $this;
    }

    /**
     * @return BeanInterface
     * @throws ViewException
     */
    public function getBean(): BeanInterface
    {
        if ($this->getBeanList()->count() === 1) {
            $bean = $this->getBeanList()->offsetGet(0);
            if ($bean instanceof BeanInterface) {
                return $bean;
            }
        }
        throw new ViewException(
            'Could not get single bean from component. Count: ' . $this->getBeanList()->count()
        );
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
     * @return AbstractField[]
     */
    public function getFieldList(): array
    {
        if ($this->hasPermissionList()) {
            return array_values(array_filter($this->field_List, function ($field) {
                return !$field->hasPermission() || in_array($field->getPermission(), $this->getPermissionList());
            }));
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
            if ($this->hasBeanConverter()) {
                $field->setBeanConverter($this->getBeanConverter());
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
        return $this->id;
    }
}
