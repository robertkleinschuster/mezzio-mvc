<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Edit;

use Mezzio\Mvc\View\Components\Base\AbstractComponent;
use Mezzio\Mvc\View\Components\Edit\Fields\Button;
use Mezzio\Mvc\View\Components\Edit\Fields\Checkbox;
use Mezzio\Mvc\View\Components\Edit\Fields\Select;
use Mezzio\Mvc\View\Components\Edit\Fields\Text;

class Edit extends AbstractComponent
{
    public function getTemplate(): string
    {
        return 'components/edit/edit';
    }

    /**
     * @param string $name
     * @param string $key
     * @return Text
     */
    public function addText(string $name, string $key): Text
    {
        $text = new Text($name, $key);
        $this->addField($text);
        return $text;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Button
     */
    public function addButton(string $name, string $key): Button
    {
        $button = new Button($name, $key);
        $this->addField($button);
        return $button;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Checkbox
     */
    public function addCheckbox(string $name, string $key): Checkbox
    {
        $checkbox = new Checkbox($name, $key);
        $this->addField($checkbox);
        return $checkbox;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Select
     */
    public function addSelect(string $name, string $key): Select
    {
        $select = new Select($name, $key);
        $this->addField($select);
        return $select;
    }

}
