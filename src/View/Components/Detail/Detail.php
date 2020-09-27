<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Detail;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;

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
     * @param string $name
     * @param string $key
     * @return Fields\Badge
     */
    public function addBadge(string $name, string $key): Fields\Badge
    {
        $badge = new Fields\Badge($name, $key);
        $this->addField($badge);
        return $badge;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\Blockquote
     */
    public function addBlockquote(string $name, string $key): Fields\Blockquote
    {
        $blockquote = new Fields\Blockquote($name, $key);
        $this->addField($blockquote);
        return $blockquote;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\Button
     */
    public function addButton(string $name, string $key): Fields\Button
    {
        $button = new Fields\Button($name, $key);
        $this->addField($button);
        return $button;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\Codeblock
     */
    public function addCodeblock(string $name, string $key): Fields\Codeblock
    {
        $codeblock = new Fields\Codeblock($name, $key);
        $this->addField($codeblock);
        return $codeblock;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\Figure
     */
    public function addFigure(string $name, string $key): Fields\Figure
    {
        $figure = new Fields\Figure($name, $key);
        $this->addField($figure);
        return $figure;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\Image
     */
    public function addImage(string $name, string $key): Fields\Image
    {
        $image = new Fields\Image($name, $key);
        $this->addField($image);
        return $image;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\Link
     */
    public function addLink(string $name, string $key): Fields\Link
    {
        $link = new Fields\Link($name, $key);
        $this->addField($link);
        return $link;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\Number
     */
    public function addNumber(string $name, string $key): Fields\Number
    {
        $number = new Fields\Number($name, $key);
        $this->addField($number);
        return $number;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\Progress
     */
    public function addProgress(string $name, string $key): Fields\Progress
    {
        $progress = new Fields\Progress($name, $key);
        $this->addField($progress);
        return $progress;
    }


    /**
     * @param string $name
     * @param string $key
     * @return Fields\Spinner
     */
    public function addSpinner(string $name, string $key): Fields\Spinner
    {
        $spinner = new Fields\Spinner($name, $key);
        $this->addField($spinner);
        return $spinner;
    }

    /**
     * @param string $text
     * @param string $key
     * @return Fields\Text
     */
    public function addText(string $text, string $key): Fields\Text
    {
        $text = new Fields\Text($text, $key);
        $this->addField($text);
        return $text;
    }
}
