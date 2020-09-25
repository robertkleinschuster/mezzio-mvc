<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Overview;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;

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
     * @param $name
     * @param $key
     * @return Fields\Badge
     */
    public function addBadge(string $name, string $key): Fields\Badge
    {
        $badge = new Fields\Badge($name, $key);
        $this->addField($badge);
        return $badge;
    }

    /**
     * @param $name
     * @param $key
     * @return Fields\Link
     */
    public function addLink(string $name, string $key): Fields\Link
    {
        $link = new Fields\Link($name, $key);
        $this->addField($link);
        return $link;
    }

    /**
     * @param $name
     * @param $key
     * @return Fields\Number
     */
    public function addNumber(string $name, string $key): Fields\Number
    {
        $number = new Fields\Number($name, $key);
        $this->addField($number);
        return $number;
    }

    /**
     * @param $name
     * @param $key
     * @return Fields\Progress
     */
    public function addProgress(string $name, string $key): Fields\Progress
    {
        $progress = new Fields\Progress($name, $key);
        $this->addField($progress);
        return $progress;
    }

    /**
     * @param $name
     * @param $key
     * @return Fields\Spinner
     */
    public function addSpinner(string $name, string $key): Fields\Spinner
    {
        $spinner = new Fields\Spinner($name, $key);
        $this->addField($spinner);
        return $spinner;
    }

    /**
     * @param $name
     * @param $key
     * @return Fields\Text
     */
    public function addText(string $name, string $key): Fields\Text
    {
        $text = new Fields\Text($name, $key);
        $this->addField($text);
        return $text;
    }
}
