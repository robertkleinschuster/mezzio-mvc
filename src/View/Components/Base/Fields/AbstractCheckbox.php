<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base\Fields;

use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Mvc\View\Components\Base\AbstractField;
use Pars\Mvc\View\Components\Base\RequiredAwareInterface;
use Pars\Mvc\View\Components\Base\RequiredAwareTrait;

/**
 * Class AbstractCheckbox
 * @package Pars\Mvc\View\Components\Base\Fields
 */
abstract class AbstractCheckbox extends AbstractField implements RequiredAwareInterface
{
    use RequiredAwareTrait;

    /**
     * @var string
     */
    private ?string $hint = null;

    /**
     * @var bool
     */
    private ?bool $checked = null;


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

    /**
     * @param BeanInterface $bean
     * @return bool
     */
    public function isChecked(BeanInterface $bean): bool
    {
        if ($bean->hasData($this->getKey()) && $bean->getData($this->getKey()) !== null) {
            return $bean->getData($this->getKey());
        }
        return $this->checked ?? false;
    }

    /**
     * @param bool $checked
     */
    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;
        return $this;
    }
}
