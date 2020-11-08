<?php

declare(strict_types=1);

namespace Pars\Mvc\Helper;

/**
 * Trait ValidationHelperAwareTrait
 * @package Pars\Mvc\Helper
 */
trait ValidationHelperAwareTrait
{

    /**
     * @var ValidationHelper
     */
    private ?ValidationHelper $validationHelper = null;

    /**
     * @return ValidationHelper
     */
    public function getValidationHelper(): ValidationHelper
    {
        if ($this->validationHelper === null) {
            $this->validationHelper = new ValidationHelper();
        }
        return $this->validationHelper;
    }
}
