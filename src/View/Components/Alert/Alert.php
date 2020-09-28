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
     * @param string $name
     * @param string $key
     * @return Fields\Text
     */
    public function addText(string $name, string $key): Fields\Text
    {
        $text = new Fields\Text($name, $key);
        $this->addField($text);
        return $text;
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

}
