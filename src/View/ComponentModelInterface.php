<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

interface ComponentModelInterface
{
    /**
     * @return ComponentDataBeanList
     */
    public function getComponentDataBeanList(): ComponentDataBeanList;

    /**
     * @param ComponentDataBeanList $componentDataBeanList
     * @return ComponentModel
     */
    public function setComponentDataBeanList(ComponentDataBeanList $componentDataBeanList): self;

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
