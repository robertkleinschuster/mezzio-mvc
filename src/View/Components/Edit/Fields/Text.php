<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Edit\Fields;

use Mezzio\Mvc\View\Components\Base\Fields\AbstractText;
use Mezzio\Mvc\View\Components\Base\Fields\RequiredAwareInterface;
use Mezzio\Mvc\View\Components\Base\Fields\RequiredAwareTrait;

class Text extends AbstractText implements RequiredAwareInterface
{
    use RequiredAwareTrait;

    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_TEXT = 'text';
    public const TYPE_HIDDEN = 'hidden';
    public const TYPE_URL = 'url';
    public const TYPE_TEL = 'tel';

    /**
     * @var string
     */
    private $hint;

    /**
     * @var string
     */
    private $type;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/edit/fields/text';
    }

    /**
    * @return string
    */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
    * @param string $hint
    *
    * @return $this
    */
    public function setHint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasHint(): bool
    {
        return $this->hint !== null;
    }


    /**
    * @return string
    */
    public function getType(): string
    {
        return $this->type ?? self::TYPE_TEXT;
    }

    /**
    * @param string $type
    *
    * @return $this
    */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
