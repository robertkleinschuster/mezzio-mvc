<?php

declare(strict_types=1);

namespace Mvc\View\Navigation;

use Mvc\Helper\PathHelperAwareInterface;
use Mvc\Helper\PathHelperAwareTrait;
use Mvc\View\Components\Base\IconAwareInterface;
use Mvc\View\Components\Base\IconAwareTrait;

class Action implements PathHelperAwareInterface, IconAwareInterface
{
    use PathHelperAwareTrait;
    use IconAwareTrait;

    /**
     * @var string
     */
    private ?string $link = null;

    /**
     * @var string
     */
    private ?string $name = null;

    /**
     * @var string
     */
    private ?string $icon = null;

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link ?? $this->getPathHelper()->getPath();
    }

    /**
     * @return bool
     */
    public function hasLink(): bool
    {
        return $this->link !== null || $this->hasPathHelper();
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return bool
     */
    public function hasName(): bool
    {
        return $this->name !== null;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
