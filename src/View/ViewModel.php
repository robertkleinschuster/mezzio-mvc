<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

use Mezzio\Mvc\Bean\TemplateDataBean;

class ViewModel implements ViewModelInterface
{

    /**
     * @var string
     */
    private $title;


    /**
     * @var TemplateDataBean
     */
    private $templateData;


    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    /**
     * @param mixed $title
     * @return ViewModel
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }



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
