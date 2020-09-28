<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Model;

use Mezzio\Mvc\Bean\TemplateDataBean;
use Mezzio\Mvc\Helper\ValidationHelper;

abstract class AbstractModel implements ModelInterface
{
    /**
     * @var TemplateDataBean
     */
    private $templateData;

    /**
     * @var ValidationHelper
     */
    private $validationHelper;

    /**
     * @return TemplateDataBean
     */
    public function getTemplateData(): TemplateDataBean
    {
        if (null == $this->templateData) {
            $this->templateData = new TemplateDataBean();
        }
        return $this->templateData;
    }

    /**
     * @return ValidationHelper
     */
    public function getValidationHelper(): ValidationHelper
    {
        if (null == $this->validationHelper) {
            $this->validationHelper = new ValidationHelper();
        }
        return $this->validationHelper;
    }


}
