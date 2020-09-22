<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

use Mezzio\Template\TemplateRendererInterface;

class ViewRenderer
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * ViewRenderer constructor.
     * @param TemplateRendererInterface $templateRenderer
     */
    public function __construct(TemplateRendererInterface $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    /**
     * @return TemplateRendererInterface
     */
    public function getTemplateRenderer(): TemplateRendererInterface
    {
        return $this->templateRenderer;
    }


    /**
     * @param View $view
     * @return string
     */
    public function render(View $view): string
    {
        return $this->getTemplateRenderer()->render(
            $view->getTemplate(),
            [
                'layout' => $view->getLayout(),
                'title' => $view->getTitle(),
                'components' => $view->getComponentList(),
                'model' => $view->getViewModel()
            ]
        );
    }
}
