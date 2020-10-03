<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

use Mezzio\Mvc\Helper\ValidationHelper;
use NiceshopsDev\Bean\BeanInterface;
use NiceshopsDev\Bean\BeanList\BeanListInterface;

class ComponentModel implements ComponentModelInterface
{

    /**
     * @var BeanListInterface
     */
    private $componentDataBeanList;

    /**
     * @var ValidationHelper
     */
    private $validationHelper;

    /**
     * @return ValidationHelper
     */
    public function getValidationHelper(): ValidationHelper
    {
        if (null === $this->validationHelper) {
            $this->validationHelper = new ValidationHelper();
        }
        return $this->validationHelper;
    }


    /**
     * ComponentModel constructor.
     */
    public function __construct()
    {
        $this->componentDataBeanList = new ComponentDataBeanList();
    }

    /**
     * @param BeanInterface $componentDataBean
     * @return $this
     * @throws \NiceshopsDev\Bean\BeanList\BeanListException
     */
    public function addComponentDataBean(BeanInterface $componentDataBean): ComponentModelInterface
    {
        $this->componentDataBeanList->addBean($componentDataBean);
        return $this;
    }

    /**
     * @return BeanListInterface
     */
    public function getComponentDataBeanList(): BeanListInterface
    {
        return $this->componentDataBeanList;
    }

    /**
     * @param BeanListInterface $componentDataBeanList
     * @return ComponentModel
     */
    public function setComponentDataBeanList(
        BeanListInterface $componentDataBeanList
    ): ComponentModelInterface {
        $this->componentDataBeanList = $componentDataBeanList;
        return $this;
    }

    /**
     * @param BeanInterface $componentDataBean
     * @return $this|ComponentModelInterface
     * @throws ViewException
     * @throws \NiceshopsDev\Bean\BeanList\BeanListException
     */
    public function setComponentDataBean(BeanInterface $componentDataBean): ComponentModelInterface
    {
        if ($this->getComponentDataBeanList()->count() >= 1) {
            throw new ViewException(
                'Could not set bean in ComponentModel. Count: ' . count($this->componentDataBeanList)
            );
        }
        $this->componentDataBeanList->offsetSet(0, $componentDataBean);
        return $this;
    }


    /**
     * @return BeanInterface
     * @throws ViewException|\NiceshopsDev\Bean\BeanList\BeanListException
     */
    public function getComponentDataBean(): BeanInterface
    {
        if ($this->getComponentDataBeanList()->count() === 1) {
            $bean = $this->getComponentDataBeanList()->offsetGet(0);
            if ($bean instanceof BeanInterface) {
                return $bean;
            }
        }
        throw new ViewException(
            'Could not get single bean from ComponentModel. Count: ' . count($this->componentDataBeanList)
        );
    }
}
