<?php

declare(strict_types=1);

namespace Mvc\Controller;

class Injector
{
    public const POSITION_BEFORE = 'before';
    public const POSITION_REPLACE = 'replace';
    public const POSITION_AFTER = 'after';

    /**
     * @var array
     */
    private $html;

    /**
     * @var array
     */
    private $template;

    /**
     * @var array
     */
    private $script;

    /**
     * Injector constructor.
     */
    public function __construct()
    {
        $this->html = [];
        $this->template = [];
        $this->script = [];
    }

    /**
     * @param string $html
     * @param string $selector
     * @param string $position
     */
    public function addHtml(string $html, string $selector, string $position)
    {
        $this->html[] = [
            'html' => $html,
            'selector' => $selector,
            'position' => $position
        ];
    }

    /**
     * @param string $template
     * @param string $selector
     * @param string $position
     */
    public function addTemplate(string $template, string $selector, string $position)
    {
        $this->template[] = [
            'template' => $template,
            'selector' => $selector,
            'position' => $position
        ];
    }

    /**
     * @param string $script
     */
    public function addScript(string $script)
    {
        $this->script[] = [
            'script' => $script,
        ];
    }

    public function toArray()
    {
        return [
            'script' => $this->script,
            'html' => $this->html,
            'template' => $this->template,
        ];
    }
}
