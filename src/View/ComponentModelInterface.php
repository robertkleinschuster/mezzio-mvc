<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

interface ComponentModelInterface
{
    /**
     * @return ComponentDataBeanInterface[]
     */
    public function getComponentDataBeanList(): array;

    /**
     * @param ComponentDataBeanInterface[] $componentDataBean_List
     * @return ComponentModel
     */
    public function setComponentDataBeanList(array $componentDataBean_List): self;

    /**
     * @param ComponentDataBeanInterface $componentDataBean
     * @return $this
     */
    public function addComponentDataBean(ComponentDataBeanInterface $componentDataBean): self;

    /**
     * @param ComponentDataBeanInterface $componentDataBean
     * @return $this
     */
    public function setComponentDataBean(ComponentDataBeanInterface $componentDataBean): self;

    /**
     * @return ComponentDataBeanInterface
     * @throws ViewException
     */
    public function getComponentDataBean(): ComponentDataBeanInterface;

}
