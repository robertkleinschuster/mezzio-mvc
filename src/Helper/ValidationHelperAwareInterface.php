<?php

declare(strict_types=1);

namespace Mvc\Helper;

interface ValidationHelperAwareInterface
{
    public function getValidationHelper(): ValidationHelper;
}
