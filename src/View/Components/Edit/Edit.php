<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Edit;

use Pars\Mvc\Controller\ControllerRequest;
use Pars\Mvc\View\Components\Base\AbstractComponent;

/**
 * Class Edit
 * @package Pars\Mvc\View\Components\Edit
 */
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
     * @return Fields\File
     */
    public function addFile(string $key, string $title): Fields\File
    {
        $file = new Fields\File($key, $title);
        $this->addField($file);
        return $file;
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
     * @param string $key
     * @param string $title
     * @return Fields\Text
     */
    public function addText(string $key, string $title): Fields\Text
    {
        $text = new Fields\Text($key, $title);
        $text->setType(Fields\Text::TYPE_TEXT);
        $this->addField($text);
        return $text;
    }

    /**
     * @param string $key
     * @param string $title
     * @param bool $new
     * @return Fields\Text
     */
    public function addPassword(string $key, string $title, bool $new = false): Fields\Text
    {
        $password = $this->addText($key, $title);
        $password->setType(Fields\Text::TYPE_PASSWORD);
        if ($new) {
            $password->setAutocomplete(Fields\Text::AUTOCOMPLETE_NEW_PASSWORD);
        } else {
            $password->setAutocomplete(Fields\Text::AUTOCOMPLETE_CURRENT_PASSWORD);
        }
        return $password;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Text
     */
    public function addEmail(string $key, string $title): Fields\Text
    {
        $password = $this->addText($key, $title);
        $password->setType(Fields\Text::TYPE_EMAIL);
        $password->setAutocomplete(Fields\Text::AUTOCOMPLETE_EMAIL);
        return $password;
    }

    /**
     * @param string $key
     * @param string $title
     * @return Fields\Text
     */
    public function addUsername(string $key, string $title): Fields\Text
    {
        $password = $this->addText($key, $title);
        $password->setType(Fields\Text::TYPE_TEXT);
        $password->setAutocomplete(Fields\Text::AUTOCOMPLETE_USERNAME);
        return $password;
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
     * @param string $title
     * @return Fields\Wysiwyg
     */
    public function addWysiwyg(string $key, string $title): Fields\Wysiwyg
    {
        $wysiwyg = new Fields\Wysiwyg($key, $title);
        $this->addField($wysiwyg);
        return $wysiwyg;
    }

    /**
     * @param string $key
     * @param string $value
     * @return Fields\Text
     */
    public function addSubmitAttribute(string $key, string $value): Fields\Text
    {
        return $this->addText($key, '')->setValue($value)->setType(Fields\Text::TYPE_HIDDEN);
    }

    /**
     * @param string $link
     * @return Fields\Text
     */
    public function addSubmitRedirect(string $link): Fields\Text
    {
        return $this->addSubmitAttribute(ControllerRequest::ATTRIBUTE_REDIRECT, $link);
    }

    /**
     * @param string $mode
     * @param string $title
     * @param string|null $redirect
     * @return Fields\Button
     */
    public function addSubmit(string $mode, string $title, string $redirect = null): Fields\Button
    {
        $result = $this->addButton(ControllerRequest::ATTRIBUTE_SUBMIT, $title)
            ->setValue($mode)
            ->setType(Fields\Button::TYPE_SUBMIT);

        if (null !== $redirect) {
            $this->addSubmitRedirect($redirect)->setAppendToColumnPrevious(true);
        }
        return $result;
    }

    /**
     * @param string $link
     * @param string $title
     * @param bool $append
     * @return Fields\Link
     */
    public function addCancel(string $link, string $title, bool $append = false): Fields\Link
    {
        return $this->addLink('cancel', $title)
            ->setLink($link)
            ->setAppendToColumnPrevious($append)
            ->setStyle(Fields\Link::STYLE_SECONDARY)
            ->setValue($title);
    }

    /**
     * @param string $title
     * @param string $redirect
     * @return Fields\Button
     */
    public function addSubmitDelete(string $title, string $redirect): Fields\Button
    {
        return $this->addSubmit(ControllerRequest::SUBMIT_MODE_DELETE, $title, $redirect);
    }

    /**
     * @param string $title
     * @param string $redirect
     * @return Fields\Button
     */
    public function addSubmitCreate(string $title, string $redirect): Fields\Button
    {
        return $this->addSubmit(ControllerRequest::SUBMIT_MODE_CREATE, $title, $redirect);
    }

    /**
     * @param string $title
     * @param string $redirect
     * @return Fields\Button
     */
    public function addSubmitSave(string $title, string $redirect): Fields\Button
    {
        return $this->addSubmit(ControllerRequest::SUBMIT_MODE_SAVE, $title, $redirect);
    }
}
