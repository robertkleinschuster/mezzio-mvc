<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base;

/**
 * Interface RequiredAwareInterface
 * @package Pars\Mvc\View\Components\Base
 */
interface RequiredAwareInterface
{

    /**
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * @param bool $required
     * @return $this;
     */
    public function setRequired(bool $required = true);
}
