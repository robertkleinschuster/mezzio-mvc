<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Detail;

use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Mvc\View\Components\Base\AbstractComponent;

/**
 * Class Detail
 * @package Pars\Mvc\View\Components\Detail
 */
class Detail extends AbstractComponent
{
    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'components/detail/detail';
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Badge
     */
    public function addBadge(string $key, ?string $title = null): Fields\Badge
    {
        $badge = new Fields\Badge($key, $title);
        $this->addField($badge);
        return $badge;
    }

    /**
     * @param string $key
     * @param string $title
     * @param string $trueValue
     * @param string $falseValue
     * @return Fields\Badge
     */
    public function addBadgeBoolean(string $key, ?string $title, string $trueValue, string $falseValue)
    {
        return $this->addBadgeState(
            $key,
            $title,
            [true => $trueValue, false => $falseValue],
            [true => Fields\Badge::STYLE_SUCCESS, false => Fields\Badge::STYLE_DANGER]
        );
    }

    /**
     * @param string $key
     * @param string $title
     * @param array $stateMap
     * @param array|null $styleMap
     * @return Fields\Badge
     */
    public function addBadgeState(string $key, ?string $title, array $stateMap, array $styleMap = null)
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
     * @param string $title
     * @param string $key
     * @return Fields\Blockquote
     */
    public function addBlockquote(string $key, ?string $title = null): Fields\Blockquote
    {
        $blockquote = new Fields\Blockquote($key, $title);
        $this->addField($blockquote);
        return $blockquote;
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Button
     */
    public function addButton(string $key, ?string $title = null): Fields\Button
    {
        $button = new Fields\Button($key, $title);
        $this->addField($button);
        return $button;
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Codeblock
     */
    public function addCodeblock(string $key, ?string $title = null): Fields\Codeblock
    {
        $codeblock = new Fields\Codeblock($key, $title);
        $this->addField($codeblock);
        return $codeblock;
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Figure
     */
    public function addFigure(string $key, ?string $title = null): Fields\Figure
    {
        $figure = new Fields\Figure($key, $title);
        $this->addField($figure);
        return $figure;
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Image
     */
    public function addImage(string $key, ?string $title = null): Fields\Image
    {
        $image = new Fields\Image($key, $title);
        $this->addField($image);
        return $image;
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Link
     */
    public function addLink(string $key, ?string $title = null): Fields\Link
    {
        $link = new Fields\Link($key, $title);
        $this->addField($link);
        return $link;
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Number
     */
    public function addNumber(string $key, string $title): Fields\Number
    {
        $number = new Fields\Number($key, $title);
        $this->addField($number);
        return $number;
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Progress
     */
    public function addProgress(string $key, ?string $title = null): Fields\Progress
    {
        $progress = new Fields\Progress($key, $title);
        $this->addField($progress);
        return $progress;
    }


    /**
     * @param string $title
     * @param string $key
     * @return Fields\Spinner
     */
    public function addSpinner(string $key, ?string $title = null): Fields\Spinner
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
    public function addText(string $key, ?string $title = null): Fields\Text
    {
        $text = new Fields\Text($key, $title);
        $this->addField($text);
        return $text;
    }
}
