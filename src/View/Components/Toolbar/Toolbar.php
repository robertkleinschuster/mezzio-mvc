<?php

declare(strict_types=1);

namespace Mvc\View\Components\Toolbar;

use Mvc\View\Components\Base\AbstractComponent;

class Toolbar extends AbstractComponent
{
    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'components/toolbar/toolbar';
    }


    /**
     * @param string $title
     * @param string $link
     * @return Fields\Link
     */
    public function addButton(string $link, string $title): Fields\Link
    {
        $button = new Fields\Link($link, $title);
        $button->setLink($link);
        $button->setValue($title);
        $button->addOption(Fields\Link::OPTION_BUTTON_STYLE);
        $button->setSize(Fields\Link::SIZE_SMALL);
        $button->setStyle(Fields\Link::STYLE_SECONDARY);
        $this->addField($button);
        return $button;
    }
}
