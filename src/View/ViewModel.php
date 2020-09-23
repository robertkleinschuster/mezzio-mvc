<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

use Mezzio\Mvc\Bean\TemplateDataBean;
use Mezzio\Mvc\View\Navigation\Navigation;

class ViewModel implements ViewModelInterface
{

    /**
     * @var string
     */
    private $title;

    /**
     * @var Navigation
     */
    private $navigation;


    /**
     * @var TemplateDataBean
     */
    private $templateData;


    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return Navigation
     */
    public function getNavigation(): Navigation
    {
        return $this->navigation;
    }

    /**
     * @return bool
     */
    public function hasNavigation(): bool
    {
        return $this->navigation !== null;
    }

    /**
     * @param Navigation $navigation
     */
    public function setNavigation(Navigation $navigation): void
    {
        $this->navigation = $navigation;
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

    /**
     * @return bool
     */
    public function hasToolbar(): bool
    {
        return false;
    }

}
