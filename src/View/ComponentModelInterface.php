<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

interface ComponentModelInterface
{
    /**
     * @return ComponentDataBean[]
     */
    public function getComponentDataBeanList(): array;

    /**
     * @param ComponentDataBean[] $componentDataBean_List
     * @return ComponentModel
     */
    public function setComponentDataBeanList(array $componentDataBean_List): self;

    /**
     * @param ComponentDataBean $componentDataBean
     * @return $this
     */
    public function addComponentDataBean(ComponentDataBean $componentDataBean): self;

    /**
     * @param ComponentDataBean $componentDataBean
     * @return $this
     */
    public function setComponentDataBean(ComponentDataBean $componentDataBean): self;

    /**
     * @return ComponentDataBean
     * @throws ViewException
     */
    public function getComponentDataBean(): ComponentDataBean;

}
