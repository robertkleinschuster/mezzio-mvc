<?php

declare(strict_types=1);

namespace Mvc\View;

use Mezzio\Template\TemplateRendererInterface;

class ViewRenderer
{
    /**
     * @var TemplateRendererInterface
     */
    private TemplateRendererInterface $templateRenderer;

    /**
     * @var string
     */
    private string $templateFolder;

    /**
     * ViewRenderer constructor.
     * @param TemplateRendererInterface $templateRenderer
     * @param string $templateFolder
     */
    public function __construct(TemplateRendererInterface $templateRenderer, string $templateFolder)
    {
        $this->templateFolder = $templateFolder;
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
     * @return string
     */
    public function getTemplateFolder(): string
    {
        return $this->templateFolder;
    }

    /**
     * @param View $view
     * @return string
     */
    public function render(View $view): string
    {
        $this->getTemplateRenderer()->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'templateFolder',
            $this->getTemplateFolder()
        );
        $this->getTemplateRenderer()->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'view',
            $view
        );
        return $this->getTemplateRenderer()->render($this->getTemplateFolder() . '::' . $view->getTemplate());
    }
}
