<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

class ComponentModel implements ComponentModelInterface
{

    /**
     * @var ComponentDataBeanList
     */
    private $componentDataBeanList;

    /**
     * ComponentModel constructor.
     */
    public function __construct()
    {
        $this->componentDataBeanList = new ComponentDataBeanList();
    }

    /**
     * @param ComponentDataBeanInterface $componentDataBean
     * @return $this
     */
    public function addComponentDataBean(ComponentDataBeanInterface $componentDataBean): ComponentModelInterface
    {
        $this->componentDataBeanList->addBean($componentDataBean);
        return $this;
    }

    /**
     * @return ComponentDataBeanList
     */
    public function getComponentDataBeanList(): ComponentDataBeanList
    {
        return $this->componentDataBeanList;
    }

    /**
     * @param ComponentDataBeanList $componentDataBeanList
     * @return ComponentModel
     */
    public function setComponentDataBeanList(ComponentDataBeanList $componentDataBeanList): ComponentModelInterface
    {
        $this->componentDataBeanList = $componentDataBeanList;
        return $this;
    }

    /**
     * @param ComponentDataBeanInterface $componentDataBean
     * @return $this|ComponentModelInterface
     * @throws ViewException
     * @throws \NiceshopsDev\Bean\BeanList\BeanListException
     */
    public function setComponentDataBean(ComponentDataBeanInterface $componentDataBean): ComponentModelInterface
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
     * @return ComponentDataBeanInterface
     * @throws ViewException|\NiceshopsDev\Bean\BeanList\BeanListException
     */
    public function getComponentDataBean(): ComponentDataBeanInterface
    {
        if ($this->getComponentDataBeanList()->count() === 1) {
            $bean = $this->getComponentDataBeanList()->offsetGet(0);
            if ($bean instanceof ComponentDataBeanInterface) {
                return $bean;
            }
        }
        throw new ViewException(
            'Could not get single bean from ComponentModel. Count: ' . count($this->componentDataBeanList)
        );
    }
}
