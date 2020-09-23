<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Overview;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;
use Mezzio\Mvc\View\Components\Overview\Fields\Icon;
use Mezzio\Mvc\View\Components\Overview\Fields\Link;

class Overview extends AbstractComponent
{

    public function getTemplate(): string
    {
        return 'components/overview/overview';
    }

    /**
     * @param $name
     * @param $key
     * @return Icon
     */
    public function addIcon(string $name, string $key): Icon
    {
        $icon = new Icon($name, $key);
        $this->addField($icon);
        return $icon;
    }

    /**
     * @param $name
     * @param $key
     * @return Link
     */
    public function addLink(string $name, string $key): Link
    {
        $link = new Link($name, $key);
        $this->addField($link);
        return $link;
    }


    /**
     * @param $name
     * @param $key
     * @return \Mezzio\Mvc\View\Components\Overview\Fields\Number
     */
    public function addNumber(string $name, string $key): \Mezzio\Mvc\View\Components\Overview\Fields\Number
    {
        $number = new \Mezzio\Mvc\View\Components\Overview\Fields\Number($name, $key);
        $this->addField($number);
        return $number;
    }

    /**
     * @param $name
     * @param $key
     * @return \Mezzio\Mvc\View\Components\Overview\Fields\Text
     */
    public function addText(string $name, string $key): \Mezzio\Mvc\View\Components\Overview\Fields\Text
    {
        $text = new \Mezzio\Mvc\View\Components\Overview\Fields\Text($name, $key);
        $this->addField($text);
        return $text;
    }

}
