<?php

declare(strict_types=1);

namespace Mvc\View;

use Mvc\Helper\ValidationHelper;
use NiceshopsDev\Bean\BeanInterface;
use NiceshopsDev\Bean\BeanList\BeanListInterface;

interface ComponentModelInterface
{
    /**
     * @return BeanListInterface
     */
    public function getComponentDataBeanList(): BeanListInterface;

    /**
     * @param BeanListInterface $componentDataBeanList
     * @return ComponentModel
     */
    public function setComponentDataBeanList(BeanListInterface $componentDataBeanList): self;

    /**
     * @param BeanInterface $componentDataBean
     * @return $this
     */
    public function addComponentDataBean(BeanInterface $componentDataBean): self;

    /**
     * @param BeanInterface $componentDataBean
     * @return $this
     */
    public function setComponentDataBean(BeanInterface $componentDataBean): self;

    /**
     * @return BeanInterface
     * @throws ViewException
     */
    public function getComponentDataBean(): BeanInterface;

    /**
     * @return ValidationHelper
     */
    public function getValidationHelper(): ValidationHelper;

}
