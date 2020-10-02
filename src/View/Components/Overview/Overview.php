<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Overview;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;

/**
 * Class Overview
 * @package Mezzio\Mvc\View\Components\Overview
 */
class Overview extends AbstractComponent
{

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'components/overview/overview';
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Badge
     */
    public function addBadge(string $key, string $title): Fields\Badge
    {
        $badge = new Fields\Badge($key, $title);
        $this->addField($badge);
        return $badge;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Link
     */
    public function addLink(string $key, string $title): Fields\Link
    {
        $link = new Fields\Link($key, $title);
        $this->addField($link);
        return $link;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Number
     */
    public function addNumber(string $key, string $title): Fields\Number
    {
        $number = new Fields\Number($key, $title);
        $this->addField($number);
        return $number;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Progress
     */
    public function addProgress(string $key, string $title): Fields\Progress
    {
        $progress = new Fields\Progress($key, $title);
        $this->addField($progress);
        return $progress;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Spinner
     */
    public function addSpinner(string $key, string $title): Fields\Spinner
    {
        $spinner = new Fields\Spinner($key, $title);
        $this->addField($spinner);
        return $spinner;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Text
     */
    public function addText(string $key, string $title): Fields\Text
    {
        $text = new Fields\Text($key, $title);
        $this->addField($text);
        return $text;
    }
}
