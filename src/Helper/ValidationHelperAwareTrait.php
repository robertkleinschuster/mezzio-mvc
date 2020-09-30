<?php


namespace Mezzio\Mvc\Helper;


trait ValidationHelperAwareTrait
{

    /**
     * @var ValidationHelper
     */
    private $validationHelper;

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
