<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

interface ComponentModelInterface
{
    /**
     * @return ComponentDataBeanListInterface
     */
    public function getComponentDataBeanList(): ComponentDataBeanListInterface;

    /**
     * @param ComponentDataBeanListInterface $componentDataBeanList
     * @return ComponentModel
     */
    public function setComponentDataBeanList(ComponentDataBeanListInterface $componentDataBeanList): self;

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
