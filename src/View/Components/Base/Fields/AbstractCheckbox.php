<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Base\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

abstract class AbstractCheckbox extends AbstractField implements RequiredAwareInterface
{
    use RequiredAwareTrait;

    /**
     * @var string
     */
    private $hint;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/checkbox';
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
}
