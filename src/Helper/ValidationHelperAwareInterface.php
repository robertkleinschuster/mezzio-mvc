<?php

declare(strict_types=1);

namespace Pars\Mvc\Helper;

/**
 * Interface ValidationHelperAwareInterface
 * @package Pars\Mvc\Helper
 */
interface ValidationHelperAwareInterface
{
    public function getValidationHelper(): ValidationHelper;
}
