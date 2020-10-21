<?php


namespace Mvc\View\Components\Base\Fields;


use Mvc\View\Components\Base\AbstractField;

abstract class AbstractFile extends AbstractField
{
    public const ACCEPT_IMAGE = 'image/*';
    public const ACCEPT_VIDEO = 'video/*';
    public const ACCEPT_AUDIO = 'audio/*';
    public const ACCEPT_TEXT = 'text/*';

    public const CAPTURE_USER = 'user';
    public const CAPTURE_ENVIRONMENT = 'environment';

    /**
     * @var string[]
     */
    private ?array $accept = null;

    private ?bool $multiple = null;

    private ?string $capture = null;

    public function getTemplate()
    {
        return 'components/base/fields/file';
    }

    /**
    * @return string
    */
    public function getAccept(): string
    {
        return implode(',', $this->accept);
    }

    /**
    * @param string $accept
    *
    * @return $this
    */
    public function setAccept(string $accept): self
    {
        $this->accept[] = $accept;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasAccept(): bool
    {
        return $this->accept !== null && count($this->accept) > 0;
    }

    /**
    * @return string
    */
    public function getCapture(): string
    {
        return $this->capture;
    }

    /**
    * @param string $capture
    *
    * @return $this
    */
    public function setCapture(string $capture): self
    {
        $this->capture = $capture;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasCapture(): bool
    {
        return $this->capture !== null;
    }

    /**
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple ?? false;
    }

    /**
     * @param bool $multiple
     */
    public function setMultiple(bool $multiple): void
    {
        $this->multiple = $multiple;
    }
}
