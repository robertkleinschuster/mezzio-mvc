<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Base\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

abstract class AbstractBadge extends AbstractField
{
    public const TYPE_PILL = 'pill';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $link;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/badge';
    }


    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasType(): bool
    {
        return $this->type !== null;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string link
     *
     * @return $this
     */
    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasLink(): bool
    {
        return $this->link !== null;
    }
}
