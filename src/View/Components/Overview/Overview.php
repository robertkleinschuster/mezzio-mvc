<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Overview;

use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Mvc\View\Components\Base\AbstractComponent;

/**
 * Class Overview
 * @package Pars\Mvc\View\Components\Overview
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
        $badge->setStyle(Fields\Badge::STYLE_PRIMARY);
        $this->addField($badge);
        return $badge;
    }

    /**
     * @param string $key
     * @param string $title
     * @param string $trueValue
     * @param string $falseValue
     */
    public function addBadgeBoolean(string $key, string $title, string $trueValue, string $falseValue)
    {
        return $this->addBadgeState(
            $key,
            $title,
            [true => $trueValue, false => $falseValue],
            [true => Fields\Badge::STYLE_SUCCESS, false => Fields\Badge::STYLE_DANGER]
        )->setWidth(50);
    }

    /**
     * @param string $key
     * @param string $title
     * @param array $stateMap
     * @param array|null $styleMap
     */
    public function addBadgeState(string $key, string $title, array $stateMap, array $styleMap = null)
    {
        $badge = $this->addBadge($key, $title);
        $badge->setFormat(function (BeanInterface $bean, Fields\Badge $badge) use ($key, $stateMap, $styleMap) {
            if (null !== $styleMap && isset($styleMap[$bean->getData($key)])) {
                $badge->setStyle($styleMap[$bean->getData($key)]);
            }
            if (isset($stateMap[$bean->getData($key)])) {
                return $stateMap[$bean->getData($key)];
            }
            return $bean->getData($key);
        });
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

    /**
     * @param string $link
     * @return Fields\Link
     */
    public function addDetailIcon(string $link)
    {
        return $this->addLink('', '')
            ->setLink($link)
            ->setValue('')
            ->setIcon(Fields\Link::ICON_SEARCH)
            ->setStyle(Fields\Link::STYLE_INFO)
            ->setOutline(true)
            ->addOption(Fields\Link::OPTION_TEXT_DECORATION_NONE)
            ->addOption(Fields\Link::OPTION_BUTTON_STYLE)
            ->setSize(Fields\Link::SIZE_SMALL)
            ->setChapter('actions');
    }

    /**
     * @param string $link
     * @return Fields\Link
     */
    public function addEditIcon(string $link)
    {
        return $this->addLink('', '')
            ->setLink($link)
            ->setValue('')
            ->setIcon(Fields\Link::ICON_EDIT_2)
            ->setStyle(Fields\Link::STYLE_WARNING)
            ->setOutline(true)
            ->addOption(Fields\Link::OPTION_TEXT_DECORATION_NONE)
            ->addOption(Fields\Link::OPTION_BUTTON_STYLE)
            ->setSize(Fields\Link::SIZE_SMALL)
            ->setChapter('actions');
    }

    public function addDeleteIcon(string $link)
    {
        return $this->addLink('', '')
            ->setLink($link)
            ->setValue('')
            ->setIcon(Fields\Link::ICON_TRASH)
            ->setStyle(Fields\Link::STYLE_DANGER)
            ->setOutline(true)
            ->addOption(Fields\Link::OPTION_TEXT_DECORATION_NONE)
            ->addOption(Fields\Link::OPTION_BUTTON_STYLE)
            ->setSize(Fields\Link::SIZE_SMALL)
            ->setChapter('actions');
    }

    public function addMoveUpIcon(string $link)
    {
        return $this->addLink('', '')
            ->setLink($link)
            ->setValue('')
            ->setIcon(Fields\Link::ICON_ARROW_UP)
            ->setStyle(Fields\Link::STYLE_SECONDARY)
            ->setOutline(true)
            ->addOption(Fields\Link::OPTION_TEXT_DECORATION_NONE)
            ->addOption(Fields\Link::OPTION_BUTTON_STYLE)
            ->setSize(Fields\Link::SIZE_SMALL)
            ->setChapter('move');
    }

    public function addMoveDownIcon(string $link)
    {
        return $this->addLink('', '')
            ->setLink($link)
            ->setValue('')
            ->setIcon(Fields\Link::ICON_ARROW_DOWN)
            ->setStyle(Fields\Link::STYLE_SECONDARY)
            ->setOutline(true)
            ->addOption(Fields\Link::OPTION_TEXT_DECORATION_NONE)
            ->addOption(Fields\Link::OPTION_BUTTON_STYLE)
            ->setSize(Fields\Link::SIZE_SMALL)
            ->setChapter('move');
    }
}
