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
     * @param string $key
     * @param string $title
     * @return Fields\Button
     */
    public function addButton(string $key, string $title): Fields\Button
    {
        $button = new Fields\Button($key, $title);
        $this->addField($button);
        return $button;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Checkbox
     */
    public function addCheckbox(string $key, string $title): Fields\Checkbox
    {
        $checkbox = new Fields\Checkbox($key, $title);
        $this->addField($checkbox);
        return $checkbox;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\RadioButtonGroup
     */
    public function addRadioButtonGroup(string $key, string $title): Fields\RadioButtonGroup
    {
        $radioButtonGroup = new Fields\RadioButtonGroup($key, $title);
        $this->addField($radioButtonGroup);
        return $radioButtonGroup;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Select
     */
    public function addSelect(string $key, string $title): Fields\Select
    {
        $select = new Fields\Select($key, $title);
        $this->addField($select);
        return $select;
    }

    /**
     * @param string $name
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
     * @param string $key
     * @param string $title
     * @return Fields\Textarea
     */
    public function addTextarea(string $key, string $title): Fields\Textarea
    {
        $textarea = new Fields\Textarea($key, $title);
        $this->addField($textarea);
        return $textarea;
    }


    /**
     * @param string $key
     * @param string $title
     * @return Fields\Link
     */
    public function addLink(string $key, string $title): Fields\Link
    {
        $link = new Fields\Link($key, $title);
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
