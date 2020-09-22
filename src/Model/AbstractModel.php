<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Model;

use Mezzio\Mvc\Bean\TemplateDataBean;

abstract class AbstractModel implements ModelInterface
{
    /**
     * @var TemplateDataBean
     */
    private $templateData;

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
}
