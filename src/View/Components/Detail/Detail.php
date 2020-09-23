<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Detail;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;
use Mezzio\Mvc\View\Components\Detail\Fields\Text;

class Detail extends AbstractComponent
{
    public function getTemplate(): string
    {
        return 'components/detail/detail';
    }


    /**
     * @param string $name
     * @param string $key
     * @return Fields\Number
     */
    public function addNumber(string $name, string $key): \Mezzio\Mvc\View\Components\Detail\Fields\Number
    {
        $number = new \Mezzio\Mvc\View\Components\Detail\Fields\Number($name, $key);
        $this->addField($number);
        return $number;
    }

    /**
     * @param string $text
     * @param string $key
     * @return $this|Text
     */
    public function addText(string $text, string $key): Text
    {
        $text = new Text($text, $key);
        $this->addField($text);
        return $this;
    }

}
