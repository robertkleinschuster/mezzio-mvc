<?php


namespace Mezzio\Mvc\View\Components\Alert;


class Alert extends \Mezzio\Mvc\View\Components\Base\AbstractComponent
{

    public const STYLE_PRIMARY = 'primary';
    public const STYLE_SECONDARY = 'secondary';
    public const STYLE_SUCCESS = 'success';
    public const STYLE_DANGER = 'danger';
    public const STYLE_WARNING = 'warning';
    public const STYLE_INFO = 'info';
    public const STYLE_LIGHT = 'light';
    public const STYLE_DARK = 'dark';

    /**
     * @var string
     */
    private $style;

    /**
     * @var string
     */
    private $heading;

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'components/alert/alert';
    }

    /**
    * @return string
    */
    public function getStyle(): string
    {
        return $this->style ?? self::STYLE_DANGER;
    }

    /**
    * @param string $style
    *
    * @return $this
    */
    public function setStyle(string $style): self
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @param string $title
     * @param string $key
     * @return Fields\Text
     */
    public function addText(string $key, string $title): Fields\Text
    {
        $text = new Fields\Text($key, $title);
        $this->addField($text);
        return $text;
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
    * @return string
    */
    public function getHeading(): string
    {
        return $this->heading;
    }

    /**
    * @param string $heading
    *
    * @return $this
    */
    public function setHeading(string $heading): self
    {
        $this->heading = $heading;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasHeading(): bool
    {
        return $this->heading !== null;
    }

}
