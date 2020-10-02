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
     * @param string $title
     * @param string $key
     * @return Fields\Badge
     */
    public function addBadge(string $key, string $title): Fields\Badge
    {
        $badge = new Fields\Badge($key, $title);
        $this->addField($badge);
        return $badge;
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Blockquote
     */
    public function addBlockquote(string $key, string $title): Fields\Blockquote
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
    public function addButton(string $key, string $title): Fields\Button
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
    public function addCodeblock(string $key, string $title): Fields\Codeblock
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
    public function addFigure(string $key, string $title): Fields\Figure
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
    public function addImage(string $key, string $title): Fields\Image
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
    public function addLink(string $key, string $title): Fields\Link
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
    public function addProgress(string $key, string $title): Fields\Progress
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
