<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

class ComponentModel implements ComponentModelInterface
{

    /**
     * @var ComponentDataBeanInterface[]
     */
    private $componentDataBean_List;

    /**
     * ComponentModel constructor.
     */
    public function __construct()
    {
        $this->componentDataBean_List = [];
    }

    /**
     * @param ComponentDataBeanInterface $componentDataBean
     * @return $this
     */
    public function addComponentDataBean(ComponentDataBeanInterface $componentDataBean): ComponentModelInterface
    {
        $this->componentDataBean_List[] = $componentDataBean;
        return $this;
    }

    /**
     * @return ComponentDataBeanInterface[]
     */
    public function getComponentDataBeanList(): array
    {
        return $this->componentDataBean_List;
    }

    /**
     * @param ComponentDataBeanInterface[] $componentDataBean_List
     * @return ComponentModel
     */
    public function setComponentDataBeanList(array $componentDataBean_List): ComponentModelInterface
    {
        $this->componentDataBean_List = $componentDataBean_List;
        return $this;
    }

    /**
     * @param ComponentDataBeanInterface $componentDataBean
     * @return $this|ComponentModelInterface
     * @throws ViewException
     */
    public function setComponentDataBean(ComponentDataBeanInterface $componentDataBean): ComponentModelInterface
    {
        if (count($this->componentDataBean_List) >= 1) {
            throw new ViewException(
                'Could not set bean in ComponentModel. Count: ' . count($this->componentDataBean_List)
            );
        }
        $this->componentDataBean_List[0] = $componentDataBean;
        return $this;
    }


    /**
     * @return ComponentDataBeanInterface
     * @throws ViewException
     */
    public function getComponentDataBean(): ComponentDataBeanInterface
    {
        if (count($this->componentDataBean_List) === 1) {
            return reset($this->componentDataBean_List);
        }
        throw new ViewException(
            'Could not get single bean from ComponentModel. Count: ' . count($this->componentDataBean_List)
        );
    }
}
