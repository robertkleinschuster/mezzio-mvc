<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base\Fields;

use Pars\Mvc\View\Components\Base\AbstractField;
use Pars\Mvc\View\Components\Base\RequiredAwareInterface;
use Pars\Mvc\View\Components\Base\RequiredAwareTrait;

/**
 * Class AbstractRadioButtonGroup
 * @package Pars\Mvc\View\Components\Base\Fields
 */
abstract class AbstractRadioButtonGroup extends AbstractField implements RequiredAwareInterface
{
    use RequiredAwareTrait;

    /**
     * @var array
     */
    private array $selectOptions = [];

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/radiobuttongroup';
    }


    /**
     * @param string $name
     * @param string $value
     * @return AbstractSelect
     */
    public function addSelectOption(string $name, string $value): self
    {
        $this->selectOptions[$value] = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getSelectOptions(): array
    {
        return $this->selectOptions ?? [];
    }

    /**
     * @param array $options
     * @return AbstractSelect
     */
    public function setSelectOptions(array $options): self
    {
        $this->selectOptions = $options;
        return $this;
    }
}
