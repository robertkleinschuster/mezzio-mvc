<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Edit;

use Mezzio\Mvc\Controller\ControllerRequest;
use Mezzio\Mvc\View\Components\Base\AbstractComponent;

class Edit extends AbstractComponent
{
    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'components/edit/edit';
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
     * @return Fields\Checkbox
     */
    public function addCheckbox(string $name, string $key): Fields\Checkbox
    {
        $checkbox = new Fields\Checkbox($name, $key);
        $this->addField($checkbox);
        return $checkbox;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\RadioButtonGroup
     */
    public function addRadioButtonGroup(string $name, string $key): Fields\RadioButtonGroup
    {
        $radioButtonGroup = new Fields\RadioButtonGroup($name, $key);
        $this->addField($radioButtonGroup);
        return $radioButtonGroup;
    }

    /**
     * @param string $name
     * @param string $key
     * @return Fields\Select
     */
    public function addSelect(string $name, string $key): Fields\Select
    {
        $select = new Fields\Select($name, $key);
        $this->addField($select);
        return $select;
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
     * @return Fields\Textarea
     */
    public function addTextarea(string $name, string $key): Fields\Textarea
    {
        $textarea = new Fields\Textarea($name, $key);
        $this->addField($textarea);
        return $textarea;
    }


    /**
     * @param string $name
     * @param string $key
     * @return Fields\Link
     */
    public function addLink(string $name, string $key): Fields\Link
    {
        $link = new Fields\Link($name, $key);
        $link->addOption(Fields\Link::OPTION_BUTTON_STYLE);
        $link->setStyle(Fields\Link::STYLE_PRIMARY);
        $this->addField($link);
        return $link;
    }

    /**
     * @param string $key
     * @param string $value
     * @return Fields\Text
     */
    public function addAttribute(string $key, string $value): Fields\Text
    {
        return $this->addText('', $key)->setValue($value)->setType(Fields\Text::TYPE_HIDDEN);
    }

    /**
     * @param string $name
     * @param string $value
     * @param string|null $redirect
     * @return Fields\Button
     */
    public function addSubmit(string $name, string $value, string $redirect = null): Fields\Button
    {
        $result = $this->addButton($name, ControllerRequest::ATTRIBUTE_SUBMIT)
            ->setValue($value)
            ->setType(Fields\Button::TYPE_SUBMIT);

        if (null !== $redirect) {
            $this->addAttribute(ControllerRequest::ATTRIBUTE_REDIRECT, $redirect);
        }
        return $result;
    }
}
